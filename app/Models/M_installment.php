<?php 
namespace App\Models;

use CodeIgniter\Model;

class M_installment extends Model
{
    protected $table = 'installment';
    protected $primaryKey = 'id_installment';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_installment','id_loan','period','amount','status','paid_at'];

    public function getInstallment($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            // return $this->where(['id_installment' => $id])->first();
            $query = $this->db->table($this->table)->select(''.$this->table.'.*, id_member')
            ->join('loan', 'loan.id_loan=' . $this->table . '.id_loan')
            ->Where(['id_member' => $id])->get()->getResultArray();
        return $query; 
        }  
       
    }
    
    public function saveInstallment($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    public function get($id)
    {
        
    }
}