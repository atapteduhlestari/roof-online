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
                'asset_group_name' => 'Bergerak',
                'created_at' => now()
            ],
            [
                'asset_group_name' => 'Tidak Bergerak',
                'created_at' => now()
            ],
        ];

        AssetGroup::insert($data);
    }
}
