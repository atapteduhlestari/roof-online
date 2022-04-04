<?php

namespace Database\Seeders;

use App\Models\Maintenance;
use Illuminate\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Perbaikan Mobil',
                'cycle_id' => 3,
                'created_at' => now()
            ],
            [
                'name' => 'Perawatan Rumah',
                'cycle_id' => 4,
                'created_at' => now()
            ]
        ];

        Maintenance::insert($data);
    }
}
