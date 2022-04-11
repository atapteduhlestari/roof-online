<?php

namespace Database\Seeders;

use App\Models\Storage;
use Illuminate\Database\Seeder;

class StorageSeeder extends Seeder
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
                'name' => 'SDB',
                'cycle_id' => 1,
                'no_doc' => 'ATL-HO-SOP-GAN-01-01',
                'created_at' => now()
            ],
            [
                'name' => 'Brankas',
                'cycle_id' => 1,
                'no_doc' => 'ATL-HO-SOP-GAN-01-02',
                'created_at' => now()
            ],
            [
                'name' => 'Server',
                'cycle_id' => 1,
                'no_doc' => 'ATL-HO-SOP-GAN-01-03',
                'created_at' => now()
            ],
        ];
        Storage::insert($data);
    }
}
