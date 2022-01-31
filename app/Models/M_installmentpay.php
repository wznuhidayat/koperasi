<?php 
namespace App\Models;

use CodeIgniter\Model;

class M_installmentpay extends Model
{
    protected $table = 'installmentpay';
    protected $primaryKey = 'id_installmentpay';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_installmentpay','id_admin'];

    public function getinstallment($id = false)
    {
        if($id === false){
            return $this->orderBy('created_at','desc')->findAll();
        }else{
            return $this->where(['id_installment' => $id])->first();
        }   
    }
    public function saveinstallment($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    
    public function getinstallmentByID($id)
    {
        return $this->where(['id_email' => $id])->first();
    }
  
    public function updateinstallment($data, $id){
        $query = $this->db->table($this->table)->update($data,['id_installment' => $id]);
        return $query;
    }
}