<?php

namespace Database\Seeders;

use App\Models\Renewal;
use Illuminate\Database\Seeder;

class RenewalSeeder extends Seeder
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
                'name' => 'Perpanjang STNK',
                'cycle_id' => 4,
                'no_doc' => 'ATL-HO-SOP-GAN-01-01',
                'created_at' => now()
            ],
            [
                'name' => 'Perpanjang Sertifikat',
                'cycle_id' => 4,
                'no_doc' => 'ATL-HO-SOP-GAN-01-02',
                'created_at' => now()
            ]
        ];
        Renewal::insert($data);
    }
}
