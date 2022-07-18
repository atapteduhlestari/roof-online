<?php

namespace Database\Seeders;

use App\Models\SBU;
use Illuminate\Database\Seeder;

class SBUSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'sbu_name' => 'HO/MD',
                'created_at' => now(),
            ],
            [
                'sbu_name' => 'Kalimalang',
                'created_at' => now(),
            ],
            [
                'sbu_name' => 'JDC',
                'created_at' => now(),
            ],
            [
                'sbu_name' => 'Fatmawati',
                'created_at' => now(),
            ],
            [
                'sbu_name' => 'Suryawijaya',
                'created_at' => now(),
            ],
            [
                'sbu_name' => 'Bandung',
                'created_at' => now(),
            ],
            [
                'sbu_name' => 'Surabaya',
                'created_at' => now(),
            ],
            [
                'sbu_name' => 'Semarang',
                'created_at' => now(),
            ],
            [
                'sbu_name' => 'Sarah',
                'created_at' => now(),
            ],
            [
                'sbu_name' => 'Asia',
                'created_at' => now(),
            ],
            [
                'sbu_name' => 'Bali',
                'created_at' => now(),
            ],
            [
                'sbu_name' => 'Jababeka',
                'created_at' => now(),
            ],
        ];

        SBU::insert($data);
    }
}
