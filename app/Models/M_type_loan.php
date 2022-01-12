<?php 
namespace App\Models;

use CodeIgniter\Model;

class M_type_loan extends Model
{
    protected $table = 'type_of_loan';
    protected $primaryKey = 'id_loan_type';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_loan_type','name_type','loan_term','description'];

    public function getType($id = false)
    {
        if($id === false){
            return $this->orderBy('created_at','desc')->findAll();
        }else{
            return $this->where(['id_loan_type' => $id])->first();
        }   
    }
    public function saveType($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    public function updateType($data, $id){
        $query = $this->db->table($this->table)->update($data,['id_loan_type' => $id]);
        return $query;
    }
}