<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Withdraw extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_withdraw'          => [
				'type'           => 'INT',
				'constraint'     => 8,
				// 'unsigned'       => true,
			],
            'id_member'          => [
				'type'           => 'INT',
				'constraint'     => 8,
				// 'unsigned'       => true,
			],
			'amount'       => [
				'type'       => 'INT',
				'constraint' => 12,
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
		$this->forge->addKey('id_withdraw', true);
        $this->forge->addForeignKey('id_member','member','id_member');
		$this->forge->createTable('withdraw');
    }

    public function down()
    {
        $this->forge->dropTable('withdraw');
    }
}
