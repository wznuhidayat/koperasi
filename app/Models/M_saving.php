<?php 
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_saving extends Model
{
    protected $table = 'saving';
    protected $primaryKey = 'id_saving';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_saving','id_member','id_type','id_admin','amount','description'];

     // datatables
     protected $column_order = [null,'id_saving', 'member_name','name_type',null,null,null];
     protected $column_search = ['name','id_saving'];
     protected $order = ['saving.created_at' => 'DESC'];
     protected $request;
     protected $db;
     protected $dt;
    public function getSaving($id = false)
    {
        if($id === false){
            return $this->orderBy('created_at','desc')->findAll();
        }else{
            return $this->where(['id_saving' => $id])->first();
        }   
    }
    public function getSaldo($id)
    {
        return $this->db->table($this->table)->select('SUM(saving.amount) as saldo')->where(['id_member' => $id])->get()->getRowArray();
    }
    public function saveDeposit($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    public function getInvoice($id)
    {
        $query = $this->db->table($this->table)->select(''.$this->table.'.*,'.$this->table.'.created_at as saving_created,member.*,member.name as member_name, admin.name as admin_name')
            ->join('member', 'member.id_member=' . $this->table . '.id_member')
            ->join('admin', 'admin.id_admin=' . $this->table . '.id_admin')
            ->Where(['id_saving' => $id])->get()->getRowArray();
        return $query;
    }
    // datatables
    public function __construct(RequestInterface $request)
    {
        // $request = Services::request();
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table)->select(''.$this->table.'.*,'.$this->table.'.created_at as saving_created,member.*,member.name as member_name, name_type')
        ->join('member', 'member.id_member=' . $this->table . '.id_member')
        ->join('type_of_saving', 'type_of_saving.id_saving_type=' . $this->table . '.id_type'); 
            

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