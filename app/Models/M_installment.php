<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_installment extends Model
{
    protected $table = 'installment';
    protected $primaryKey = 'id_installment';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_installment', 'id_loan', 'period', 'amount', 'status', 'paid_at'];


    protected $column_order = ['id_installment', 'id_installment', 'period', null, null, null];
    protected $column_search = ['period', 'id_installment'];
    protected $order = ['period' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;

    public function getInstallment($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            // return $this->where(['id_installment' => $id])->first();
            $query = $this->db->table($this->table)->select('' . $this->table . '.*, id_member')
                ->join('loan', 'loan.id_loan=' . $this->table . '.id_loan')
                ->Where(['id_member' => $id])->get()->getResultArray();
            return $query;
        }
    }
    public function getInvoiceInstallment($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            // return $this->where(['id_installment' => $id])->first();
            $query = $this->db->table($this->table)->select('' . $this->table . '.*, id_member')
                ->join('loan', 'loan.id_loan=' . $this->table . '.id_loan')
                ->Where(['id_installment' => $id])->get()->getRowArray();
            return $query;
        }
    }

    public function saveInstallment($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    public function pay($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, ['id_installment' => $id]);
        return $query;
    }
    // datatables
    public function __construct(RequestInterface $request)
    {
        // $request = Services::request();
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table)->select('' . $this->table . '.*, id_member')
            ->join('loan', 'loan.id_loan=' . $this->table . '.id_loan');
    }

    private function getDatatablesQuery($id)
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

    public function getDatatables($id, $loan = false)
    {
        if ($id === false) {
            $this->getDatatablesQuery($id);
            if ($this->request->getPost('length') != -1)
                $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
            $query = $this->dt->getWhere(['id_member' => $id]);
            return $query->getResult();
        } else {
            $this->getDatatablesQuery($id);
            if ($this->request->getPost('length') != -1)
                $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
            $query = $this->dt->getWhere(['' . $this->table . '.id_loan' => $loan, 'id_member' => $id]);
            return $query->getResult();
        }
    }

    public function countFiltered($id, $loan = false)
    {
        if ($loan === false) {
            $this->getDatatablesQuery($id);
            if ($id != null) {
                return $this->db->table($this->table)->select('' . $this->table . '.*, id_member')
                    ->join('loan', 'loan.id_loan=' . $this->table . '.id_loan')->where('id_member', $id)->countAllResults();
            } else {
                return 0;
            }
        } else {
            $this->getDatatablesQuery($id);
            if ($id != null) {
                return $this->db->table($this->table)->select('' . $this->table . '.*, id_member')
                    ->join('loan', 'loan.id_loan=' . $this->table . '.id_loan')->where(['' . $this->table . '.id_loan' => $loan, 'id_member' => $id])->countAllResults();
            } else {
                return 0;
            }
        }
    }

    public function countAll($id, $loan = false)
    {
        if ($loan === false) {
            $tbl_storage = $this->db->table($this->table)->select('' . $this->table . '.*, id_member')
                ->join('loan', 'loan.id_loan=' . $this->table . '.id_loan')->where('id_member', $id);
            return $tbl_storage->countAllResults();
        } else {
            $tbl_storage = $this->db->table($this->table)->select('' . $this->table . '.*, id_member')
                ->join('loan', 'loan.id_loan=' . $this->table . '.id_loan')->where(['' . $this->table . '.id_loan' => $loan, 'id_member' => $id]);
            return $tbl_storage->countAllResults();
        }
    }
}
