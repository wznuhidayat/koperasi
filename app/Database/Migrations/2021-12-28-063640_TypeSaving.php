<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TypeSaving extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_saving_type'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				// 'unsigned'       => true,
			],
			'name_type'       => [
				'type'       => 'VARCHAR',
				'constraint' => '30',
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
		$this->forge->addKey('id_saving_type', true);
		$this->forge->createTable('type_of_saving');
    }

    public function down()
    {
        $this->forge->dropTable('type_of_saving');
    }
}
