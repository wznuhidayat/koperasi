<?php 
namespace App\Models;

use CodeIgniter\Model;

class M_admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_admin','name','phone','password','gender','role','img'];

    public function getAdmin($id = false)
    {
        if($id === false){
            return $this->orderBy('created_at','desc')->findAll();
        }else{
            return $this->where(['id_admin' => $id])->first();
        }   
    }
    public function saveAdmin($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    // public function updateAdmin($data, $id){
    //     $query = $this->db->table($this->table)->update($data,['id_admin' => $id]);
    //     return $query;
    // }
    public function getAdminByID($id)
    {
        return $this->where(['id_email' => $id])->first();
    }
    // public function countAdmin(){
    //     $query = $this->db->table($this->table)->countAll();
    //     return $query;
    // }
    public function updateAdmin($data, $id){
        $query = $this->db->table($this->table)->update($data,['id_admin' => $id]);
        return $query;
    }
}