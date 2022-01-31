<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Installmentpay extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_installmentpay'          => [
				'type'           => 'INT',
				'constraint'     => 8,
			],
			'id_admin'          => [
				'type'           => 'INT',
				'constraint'     => 8,
			],
			'created_at'       => [
				'type'       => 'DATETIME',
				'null'		=> true,
			],
			
		]);
		$this->forge->addKey('id_installmentpay', true);
        $this->forge->addForeignKey('id_admin','admin','id_admin');
		$this->forge->createTable('installmentpay');
    }

    public function down()
    {
        $this->forge->dropTable('installmentpay');
    }
}
