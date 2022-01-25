<?php

namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_withdraw extends Model
{
    protected $table = 'withdraw';
    protected $primaryKey = 'id_withdraw';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_withdraw', 'id_member', 'id_type', 'amount', 'description'];

     // datatables
     protected $column_order = [null,'id_withdraw', 'member_name',null,null,null];
     protected $column_search = ['id_withdraw'];
     protected $order = ['withdraw.created_at' => 'DESC'];
     protected $request;
     protected $db;
     protected $dt;

    public function getwithdraw($id = false)
    {
        if ($id === false) {
            return $this->orderBy('created_at', 'desc')->findAll();
        } else {
            return $this->where(['id_withdraw' => $id])->first();
        }
    }
    public function allWithdraw($id)
    {
        return $this->db->table($this->table)->select('SUM(withdraw.amount) as saldo')->where(['id_member' => $id])->get()->getRowArray();
    }
    public function saveWithdraw($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    public function getInvoice($id)
    {
        $query = $this->db->table($this->table)->select(''.$this->table.'.*,'.$this->table.'.created_at as wd_created,member.*,member.name as member_name, admin.name as admin_name')
            ->join('member', 'member.id_member=' . $this->table . '.id_member')
            ->join('admin', 'admin.id_admin=' . $this->table . '.id_admin')
            ->Where(['id_withdraw' => $id])->get()->getRowArray();
        return $query;
    }

    // datatables
    public function __construct(RequestInterface $request)
    {
        // $request = Services::request();
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table)->select(''.$this->table.'.*,'.$this->table.'.created_at as wd_created,member.*,member.name as member_name')
        ->join('member', 'member.id_member=' . $this->table . '.id_member');
            

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
            $query = $this->dt->get();
            return $query->getResult();
        } else {
            $this->getDatatablesQuery();
            if ($this->request->getPost('length') != -1)
                $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
            $query = $this->dt->getWhere(['' . $this->table . '.id_member' => $id]);
            return $query->getResult();
        }
    }

    public function countFiltered($id = false)
    {
        if ($id === false) {
            $this->getDatatablesQuery();
            return $this->dt->countAllResults();
        } else {
            $this->getDatatablesQuery();
            return $this->dt->where(['' . $this->table . '.id_member' => $id])->countAllResults();
        }
    }
    public function sumWithdraw()
    {
        return $this->db->table($this->table)->select('sum(amount) as totalAmount')->get()->getRowArray();   
    }
    public function countAll($id = false)
    {
        if ($id === false) {
            $tbl_storage = $this->db->table($this->table);
            return $tbl_storage->countAllResults();
        }else{
            $tbl_storage = $this->db->table($this->table)->where(['' . $this->table . '.id_member' => $id]);
            return $tbl_storage->countAllResults();
        }
    }
}
