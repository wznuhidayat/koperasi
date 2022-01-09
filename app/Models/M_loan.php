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
    public function getInvoice($id)
    {
        $query = $this->db->table($this->table)->select(''.$this->table.'.*,'.$this->table.'.created_at as loan_created,'.$this->table.'.name as loan_name,member.*, admin.name as admin_name, type_of_loan.loan_term as installment_term')
            ->join('member', 'member.id_member=' . $this->table . '.id_member')
            ->join('admin', 'admin.id_admin=' . $this->table . '.id_admin')
            ->join('type_of_loan', 'type_of_loan.id_loan_type=' . $this->table . '.id_type')
            ->Where(['id_loan' => $id])->get()->getRowArray();
        return $query;
    }
}