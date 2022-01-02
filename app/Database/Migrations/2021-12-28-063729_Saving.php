<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Saving extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_saving'          => [
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
		$this->forge->addKey('id_saving', true);
        $this->forge->addForeignKey('id_member','member','id_member');
		$this->forge->addForeignKey('id_type','type_of_saving','id_saving_type');
		$this->forge->createTable('saving');
    }

    public function down()
    {
        $this->forge->dropTable('saving');
    }
}
