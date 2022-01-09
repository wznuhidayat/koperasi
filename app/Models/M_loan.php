<?php 
namespace App\Models;

use CodeIgniter\Model;

class M_loan extends Model
{
    protected $table = 'loan';
    protected $primaryKey = 'id_loan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_loan','id_member','id_type','id_admin','name','amount','installment_fee','description'];
    public function saveLoan($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
}