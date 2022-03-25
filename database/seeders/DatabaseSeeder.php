<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeedeR::class);
        $this->call(CycleSeeder::class);
        $this->call(AssetGroupSeeder::class);
        // \App\Models\User::factory(10)->create();
        // \App\Models\Cycle::factory(10000)->create();
    }
}
