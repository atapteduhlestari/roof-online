<?php

namespace Database\Seeders;

use App\Models\AssetGroup;
use Illuminate\Database\Seeder;

class AssetGroupSeeder extends Seeder
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
                'asset_group_name' => 'Aktiva Tetap',
                'created_at' => now()
            ],
            [
                'asset_group_name' => 'Aktiva Lancar',
                'created_at' => now()
            ],
        ];

        AssetGroup::insert($data);
    }
}
