<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Settings extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_setting'          => [
				'type'           => 'INT',
				'constraint'     => 8,
			],
            'title'       => [
				'type'       => 'VARCHAR',
				'constraint' => '30',
			],
			'address'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
            'contact'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
		]);
		$this->forge->createTable('settings');
    }

    public function down()
    {
        $this->forge->dropTable('settings');
    }
}
