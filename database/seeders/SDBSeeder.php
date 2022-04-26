<?php

namespace Database\Seeders;

use App\Models\SDB;
use Illuminate\Database\Seeder;

class SDBSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'sdb_name' => 'SDB Bank BCA',
                'pcs_date' => now(),
                'pcs_value' => 1000000,
                'due_date' => now()->addYears(5),
            ],
            [
                'sdb_name' => 'SDB Bank Mandiri',
                'pcs_date' => now(),
                'pcs_value' => 1000000,
                'due_date' => now()->addYears(5),
            ],
        ];

        SDB::insert($data);
    }
}
