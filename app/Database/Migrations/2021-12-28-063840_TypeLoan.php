<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TypeLoan extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_loan_type'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				
			],
            
			'name_type'       => [
				'type'       => 'VARCHAR',
				'constraint' => '30',
			],
            'amount'       => [
				'type'       => 'INT',
				'constraint'		=> 12,
			],
			'installment_fee'       => [
				'type'       => 'DECIMAL',
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
		$this->forge->addKey('id_loan_type', true);
		$this->forge->createTable('type_of_loan');
    }

    public function down()
    {
        $this->forge->dropTable('type_of_loan');
    }
}
