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
				'constraint'     => 12,
			],
            
            'id_loan'          => [
				'type'           => 'INT',
				'constraint'     => 8,
			],
			'period'       => [
				'type'       => 'INT',
				'constraint'		=> 6,
			],
            'amount'       => [
				'type'       => 'BIGINT',
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
			'id_admin'          => [
				'type'           => 'INT',
				'constraint'     => 8,
				'null' => true
			],
		
			
			
		]);
		$this->forge->addKey('id_installment', true);
		$this->forge->addForeignKey('id_loan','loan','id_loan','CASCADE','CASCADE');
		$this->forge->createTable('installment');
    }

    public function down()
    {
        $this->forge->dropTable('installment');
    }
}
