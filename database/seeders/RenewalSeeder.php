<?php

namespace Database\Seeders;

use App\Models\Renewal;
use Illuminate\Database\Seeder;

class RenewalSeeder extends Seeder
{
    public function run()
    {

        $data = [
            [
                'name' => 'Perpanjang STNK',
                'cycle_id' => 4,
                'no_doc' => 'ATL-HOJ-SOP-GAN-04-01',
                'created_at' => now()
            ],
            [
                'name' => 'Perpanjang Sertifikat',
                'cycle_id' => 4,
                'no_doc' => null,
                'created_at' => now()
            ],
            [
                'name' => 'Pembayaran PBB',
                'cycle_id' => 4,
                'no_doc' => null,
                'created_at' => now()
            ],
        ];
        Renewal::insert($data);
    }
}
