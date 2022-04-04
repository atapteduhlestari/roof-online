<?php

namespace Database\Seeders;

use App\Models\Cycle;
use Illuminate\Database\Seeder;

class CycleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'cycle_name' => 'Daily',
                'cycle_type' => 'D',
                'qty' => '1',
                'created_at' => now(),
            ],
            [
                'cycle_name' => 'Weekly',
                'cycle_type' => 'D',
                'qty' => '7',
                'created_at' => now(),
            ],
            [
                'cycle_name' => 'Monthly',
                'cycle_type' => 'M',
                'qty' => '1',
                'created_at' => now(),
            ],
            [
                'cycle_name' => 'Yearly',
                'cycle_type' => 'M',
                'qty' => '1',
                'created_at' => now(),
            ],
            [
                'cycle_name' => 'Accidentally',
                'cycle_type' => '0',
                'qty' => '0',
                'created_at' => now(),
            ],
        ];

        Cycle::insert($data);
    }
}
