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
			'name'       => [
				'type'       => 'VARCHAR',
				'constraint' => '30',
				'null'	=> true,
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
			
		]);
		$this->forge->addKey('id_loan', true);
		$this->forge->addForeignKey('id_member','member','id_member');
		$this->forge->addForeignKey('id_type','type_of_loan','id_loan_type');
		$this->forge->createTable('loan');
    }

    public function down()
    {
        $this->forge->dropTable('loan');
    }
}
