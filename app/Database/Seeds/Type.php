<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Type extends Seeder
{
    public function run()
    {
        $loan = [
            [
                'id_loan_type' => 11111,
                'name_type' => '1 Tahun',
                'loan_term' => 12,
                'description' => 'loan dengan cicilan satu tahun'
            ],
            [
                'id_loan_type' => 22222,
                'name_type' => '2 Tahun',
                'loan_term' => 24,
                'description' => 'loan dengan cicilan dua tahun'
            ]
        ];
        $saving = [
            [
                'id_saving_type' => 11111,
                'name_type' => 'Simpanan Pokok',
                'description' => '-'
            ],
            [
                'id_saving_type' => 22222,
                'name_type' => 'Simpanan Wajib',
                'description' => '-',
            ]

        ];

        $this->db->table('type_of_saving')->insert($saving);
        $this->db->table('type_of_loan')->insert($loan);
    }
}
