<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
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
                'name' => 'Lenny Magdalena Keluanan',
                'created_at' => now()
            ],
            [
                'name' => 'Tri Wahyuni',
                'created_at' => now()
            ],
            [
                'name' => 'Lena Nuri Kristina Pasaribu',
                'created_at' => now()
            ],
            [
                'name' => 'Buddy Asmi',
                'created_at' => now()
            ],
            [
                'name' => 'Arnida Dwiprasetianna',
                'created_at' => now()
            ],
            [
                'name' => 'Sammy Gunawan Prioutomo',
                'created_at' => now()
            ],
            [
                'name' => 'Dian Purnamasari',
                'created_at' => now()
            ],
            [
                'name' => 'Tresnawati',
                'created_at' => now()
            ],
            [
                'name' => 'Trees Moedjiastati',
                'created_at' => now()
            ],
            [
                'name' => 'Rosyid Koeswara',
                'created_at' => now()
            ],
            [
                'name' => 'Mozes Nelson Ndun',
                'created_at' => now()
            ],
            [
                'name' => 'Hendar',
                'created_at' => now()
            ],
            [
                'name' => 'Astri Budiyono',
                'created_at' => now()
            ],
            [
                'name' => 'Sutino Tarso Nurhadi',
                'created_at' => now()
            ],
            [
                'name' => 'Tentri Pidana Simanjuntak',
                'created_at' => now()
            ],
            [
                'name' => 'Edward Evbert Angkouw',
                'created_at' => now()
            ],
            [
                'name' => 'Ari Rizkita',
                'created_at' => now()
            ],
        ];
        DB::table('employees')->insert($data);
    }
}
