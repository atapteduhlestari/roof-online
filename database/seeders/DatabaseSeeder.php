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
        $this->call(UserSeeder::class);
        $this->call(CycleSeeder::class);
        $this->call(AssetGroupSeeder::class);
        $this->call(AssetSeeder::class);
        $this->call(RenewalSeeder::class);
        $this->call(StorageSeeder::class);
        $this->call(MaintenanceSeeder::class);

        \App\Models\Employee::factory(25)->create();

        // \App\Models\User::factory(10)->create();
        // \App\Models\Cycle::factory(10000)->create();
    }
}
