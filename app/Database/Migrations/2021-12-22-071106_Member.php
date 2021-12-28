<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Member extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_member'          => [
				'type'           => 'INT',
				'constraint'     => 8,
				// 'unsigned'       => true,
			],
			'name'       => [
				'type'       => 'VARCHAR',
				'constraint' => '30',
				'null'	=> true,
			],
            'date_of_birth'       => [
				'type'       => 'DATE',
				'null'		=> true,
			],
			'phone'       => [
				'type'       => 'INT',
				'constraint' => 12,
			],
			'address'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'gender'       => [
				'type'       => 'ENUM',
				'constraint' => ['male', 'female'],
				'null'		=> true,
			],
			
			'created_at'       => [
				'type'       => 'DATETIME',
				'null'		=> true,
			],
			
		]);
		$this->forge->addKey('id_member', true);
		$this->forge->createTable('member');
    }

    public function down()
    {
        $this->forge->dropTable('member');
    }
}
