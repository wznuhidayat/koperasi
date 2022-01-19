<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_loan extends Model
{
    protected $table = 'loan';
    protected $primaryKey = 'id_loan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_loan', 'id_member', 'id_type', 'id_admin', 'name', 'amount', 'installment_fee', 'description'];
    // datatables
    protected $column_order = [null, 'id_loan', 'member_name', 'loan_term', null, null, null];
    protected $column_search = ['member_name', 'id_loan'];
    protected $order = ['created_at' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;
    public function saveLoan($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    public function getInvoice($id)
    {
        $query = $this->db->table($this->table)->select('' . $this->table . '.*,' . $this->table . '.created_at as loan_created,' . $this->table . '.name as loan_name,member.*, admin.name as admin_name, type_of_loan.loan_term as installment_term')
            ->join('member', 'member.id_member=' . $this->table . '.id_member')
            ->join('admin', 'admin.id_admin=' . $this->table . '.id_admin')
            ->join('type_of_loan', 'type_of_loan.id_loan_type=' . $this->table . '.id_type')
            ->Where(['id_loan' => $id])->get()->getRowArray();
        return $query;
    }
    public function getLastRecord($id)
    {
        return $this->where('id_member', $id)->orderBy('created_at', 'desc')->limit(1)->get()->getRowArray();
    }
    // datatables
    public function __construct(RequestInterface $request)
    {
        // $request = Services::request();
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table)->select('' . $this->table . '.*,member.name as member_name, loan_term')
            ->join('member', 'member.id_member=' . $this->table . '.id_member')
            ->join('type_of_loan', 'type_of_loan.id_loan_type=' . $this->table . '.id_type');
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

    public function getDatatables()
    {
        $this->getDatatablesQuery();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function countFiltered()
    {
        $this->getDatatablesQuery();
        return $this->dt->countAllResults();
    }

    public function countAll()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }
}
