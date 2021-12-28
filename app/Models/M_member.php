<?php 
namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_member extends Model
{
    protected $table = 'member';
    protected $primaryKey = 'id_member';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_member','name','date_of_birth','phone','address','gender'];

    // datatables
    protected $column_order = [null,'id_member', 'name','phone','gender',null];
    protected $column_search = ['name','id_member'];
    protected $order = ['created_at' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;


    public function getMember($id = false)
    {
        if($id === false){
            return $this->orderBy('created_at','desc')->findAll();
        }else{
            return $this->where(['id_member' => $id])->first();
        }   
    }
    public function saveMember($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    public function updateMember($data, $id){
        $query = $this->db->table($this->table)->update($data,['id_member' => $id]);
        return $query;
    }
   
    public function countMember(){
        $query = $this->db->table($this->table)->countAll();
        return $query;
    }

    // datatables
    public function __construct(RequestInterface $request)
    {
        // $request = Services::request();
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table); 
            

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