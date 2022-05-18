<?php

namespace Database\Seeders;

use App\Models\Maintenance;
use Illuminate\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Ganti Oli',
                'cycle_id' => 5,
                'no_doc' => 'ATL-HOJ-SOP-GAN-01-03',
                'created_at' => now()
            ],
            [
                'name' => 'Turun Mesin',
                'cycle_id' => 3,
                'no_doc' => 'ATL-HOJ-SOP-GAN-01-03',
                'created_at' => now()
            ],
            [
                'name' => 'Renovasi Rumah',
                'cycle_id' => 5,
                'no_doc' => 'ATL-HOJ-SOP-GAN-02-02',
                'created_at' => now()
            ],
            [
                'name' => 'Renovasi Kantor',
                'cycle_id' => 5,
                'no_doc' => 'ATL-HOJ-SOP-GAN-02-02',
                'created_at' => now()
            ],
        ];

        Maintenance::insert($data);
    }
}
