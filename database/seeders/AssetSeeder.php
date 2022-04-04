<?php

namespace Database\Seeders;

use App\Models\Asset;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
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
                'asset_group_id' => 1,
                'user_id' => 2,
                'asset_name' => 'Mobil',
                'created_at' => now()
            ],
            [
                'asset_group_id' => 2,
                'user_id' => 2,
                'asset_name' => 'Rumah',
                'created_at' => now()
            ]
        ];
        Asset::insert($data);
    }
}
