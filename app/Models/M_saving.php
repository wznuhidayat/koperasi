<?php 
namespace App\Models;

use CodeIgniter\Model;

class M_saving extends Model
{
    protected $table = 'saving';
    protected $primaryKey = 'id_saving';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_saving','id_member','id_type','id_admin','amount','description'];

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
}