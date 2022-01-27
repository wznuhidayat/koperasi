<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Setting extends Seeder
{
    public function run()
    {
        $data = [
            'id_setting' => 11111111,
            'title' => 'Koperasi Indonesia',
            'address' => 'From
            Admin, Inc.
            795 Folsom Ave, Suite 600
            San Francisco, CA 94107',
            'contact' => ' Phone: (804) 123-5432
            Email: info@almasaeedstudio.com',
        ];


        // Using Query Builder
        $this->db->table('settings')->insert($data);
    }
}
