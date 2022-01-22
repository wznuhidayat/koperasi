<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_installment_dt extends Model
{
    protected $table = 'installment';
    protected $primaryKey = 'id_installment';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_installment', 'id_loan', 'period', 'amount', 'status', 'paid_at'];


    protected $column_order = [null, 'id_installment', 'member_name', 'period', null, null, 'admin_name'];
    protected $column_search = ['period', 'id_installment'];
    protected $order = ['period' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;
    // datatables
    public function __construct(RequestInterface $request)
    {
        // $request = Services::request();
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table)->select('' . $this->table . '.*, (select member.name as name from loan join member on loan.id_member = member.id_member WHERE id_loan = installment.id_loan) as member_name, admin.name as admin_name')
            ->join('loan', 'loan.id_loan=' . $this->table . '.id_loan')
            ->join('admin', 'admin.id_admin=' . $this->table . '.id_admin');
    }

    private function getDatatablesQuery()
    {
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    public function getDatatables($id = false)
    {
        if ($id === false) {
            $this->getDatatablesQuery();
            if ($this->request->getPost('length') != -1)
                $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
            $query = $this->dt->getWhere(['status' => 'paid']);
            return $query->getResult();
        } else {
            $this->getDatatablesQuery();
            if ($this->request->getPost('length') != -1)
                $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
            $query = $this->db->table($this->table)->select('' . $this->table . '.*, (select member.name as name from loan join member on loan.id_member = member.id_member WHERE id_loan = installment.id_loan) as member_name, admin.name as admin_name')
                ->join('loan', 'loan.id_loan=' . $this->table . '.id_loan')
                ->join('admin', 'admin.id_admin=' . $this->table . '.id_admin')->getWhere(['id_member' => $id,'status' => 'paid']);
            return $query->getResult();
        }
    }

    public function countFiltered($id = false)
    {
        if ($id === false) {
            $this->getDatatablesQuery();
            return $this->dt->where(['status' => 'paid'])->countAllResults();
        } else {
            $this->getDatatablesQuery();
            return $this->db->table($this->table)->select('' . $this->table . '.*, (select member.name as name from loan join member on loan.id_member = member.id_member WHERE id_loan = installment.id_loan) as member_name, admin.name as admin_name')
                ->join('loan', 'loan.id_loan=' . $this->table . '.id_loan')
                ->join('admin', 'admin.id_admin=' . $this->table . '.id_admin')->where(['id_member' => $id,'status' => 'paid'])->countAllResults();
        }
    }

    public function countAll($id = false)
    {
        if ($id === false) {
            $tbl_storage = $this->db->table($this->table)->where(['status' => 'paid']);
            return $tbl_storage->countAllResults();
        }else{
            $tbl_storage = $this->db->table($this->table)->select('' . $this->table . '.*, (select member.name as name from loan join member on loan.id_member = member.id_member WHERE id_loan = installment.id_loan) as member_name, admin.name as admin_name')
            ->join('loan', 'loan.id_loan=' . $this->table . '.id_loan')
            ->join('admin', 'admin.id_admin=' . $this->table . '.id_admin')->where(['id_member' => $id,'status' => 'paid']);
            return $tbl_storage->countAllResults();
        }
    }
}
