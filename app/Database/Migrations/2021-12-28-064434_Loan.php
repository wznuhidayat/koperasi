<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Loan extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_loan'          => [
				'type'           => 'INT',
				'constraint'     => 8,
				// 'unsigned'       => true,
			],
            'id_member'          => [
				'type'           => 'INT',
				'constraint'     => 8,
				// 'unsigned'       => true,
			],
            'id_type'          => [
				'type'           => 'INT',
				'constraint'     => 8,
				// 'unsigned'       => true,
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
			'amount'       => [
				'type'       => 'INT',
				'constraint'		=> 12,
			],
			'installment_fee'       => [
				'type'       => 'DECIMAL',
				'constraint' => 5,
			],
			'status'       => [
				'type'       => 'INT',
				'constraint' => 5,
			],
			'description'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'created_at'       => [
				'type'       => 'DATETIME',
				'null'		=> true,
			],
			'updated_at'       => [
				'type'       => 'DATETIME',
				'null'		=> true,
			],
			
			
		]);
		$this->forge->addKey('id_loan', true);
		$this->forge->addForeignKey('id_member','member','id_member');
		$this->forge->addForeignKey('id_type','type_of_loan','id_loan_type');
		$this->forge->addForeignKey('id_admin','admin','id_admin');
		$this->forge->createTable('loan');
    }

    public function down()
    {
        $this->forge->dropTable('loan');
    }
}
