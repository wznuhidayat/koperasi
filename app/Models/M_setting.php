<?php 
namespace App\Models;

use CodeIgniter\Model;

class M_setting extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id_setting';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_setting','title','address','contact'];

    public function getsetting($id = false)
    {
        if($id === false){
            return $this->orderBy('created_at','desc')->findAll();
        }else{
            return $this->where(['id_setting' => $id])->first();
        }   
    }
    public function savesetting($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
   
    public function updateAdmin($data, $id){
        $query = $this->db->table($this->table)->update($data,['id_setting' => $id]);
        return $query;
    }
}