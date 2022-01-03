<?php 
namespace App\Models;

use CodeIgniter\Model;

class M_withdraw extends Model
{
    protected $table = 'withdraw';
    protected $primaryKey = 'id_withdraw';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_withdraw','id_member','id_type','amount','description'];

    public function getwithdraw($id = false)
    {
        if($id === false){
            return $this->orderBy('created_at','desc')->findAll();
        }else{
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
}