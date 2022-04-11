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
                'no_doc' => 'ATL-HO-SOP-GAN-01-01',
                'created_at' => now()
            ],
            [
                'name' => 'Perawatan Rumah',
                'cycle_id' => 4,
                'no_doc' => 'ATL-HO-SOP-GAN-01-02',
                'created_at' => now()
            ]
        ];

        Maintenance::insert($data);
    }
}
