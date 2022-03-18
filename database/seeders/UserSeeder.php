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
                'created_at' => now(),
            ],
            [
                'name'  => 'Super Admin',
                'email' => 'superadmin@example.com',
                'username' => 'superadmin',
                'password' => Hash::make('password'),
                'created_at' => now(),
            ],
        ];
        User::insert($data);
    }
}
