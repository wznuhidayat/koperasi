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
			'id_admin'          => [
				'type'           => 'INT',
				'constraint'     => 8,
			],
			'amount'       => [
				'type'       => 'BIGINT',
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
        $this->forge->addForeignKey('id_member','member','id_member','CASCADE','CASCADE');
        $this->forge->addForeignKey('id_admin','admin','id_admin');
		$this->forge->createTable('withdraw');
    }

    public function down()
    {
        $this->forge->dropTable('withdraw');
    }
}
