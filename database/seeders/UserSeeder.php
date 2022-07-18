<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data =  [
            [
                'name'  => 'Admin',
                'email' => 'admin@example.com',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'is_admin' => 2,
                'sbu_id' => 1,
                'created_at' => now(),
            ],
            [
                'name'  => 'Tri Wahyuni',
                'email' => 'superadmin@example.com',
                'username' => 'superadmin',
                'is_admin' => 1,
                'sbu_id' => 1,
                'password' => Hash::make('password'),
                'created_at' => now(),
            ],
        ];
        User::insert($data);
    }
}
