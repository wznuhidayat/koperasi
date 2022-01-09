<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Installment extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_installment'          => [
				'type'           => 'INT',
				'constraint'     => 8,
			],
            
            'id_loan'          => [
				'type'           => 'INT',
				'constraint'     => 8,
			],
			'id_admin'          => [
				'type'           => 'INT',
				'constraint'     => 8,
			],
			'name'       => [
				'type'       => 'VARCHAR',
				'constraint' => '30',
				'null'	=> true,
			],
			'period'       => [
				'type'       => 'INT',
				'constraint'		=> 6,
			],
            'amount'       => [
				'type'       => 'INT',
				'constraint'		=> 12,
			],
            'status'       => [
				'type'       => 'ENUM',
				'constraint' => ['paid', 'unpaid'],
				'null'		=> true,
			],
			'paid_at'       => [
				'type'       => 'DATETIME',
				'null'		=> true,
			],
		
			
			
		]);
		$this->forge->addKey('id_installment', true);
		$this->forge->addForeignKey('id_loan','loan','id_loan','CASCADE','CASCADE');
		$this->forge->addForeignKey('id_admin','admin','id_admin');
		$this->forge->createTable('installment');
    }

    public function down()
    {
        $this->forge->dropTable('installment');
    }
}
