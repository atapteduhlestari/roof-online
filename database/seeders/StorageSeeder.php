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
                'created_at' => now()
            ],
            [
                'name' => 'Brankas',
                'created_at' => now()
            ],
            [
                'name' => 'Server',
                'created_at' => now()
            ],
        ];
        Storage::insert($data);
    }
}
