<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Pentadbir',
                'slug' => 'pentadbir',
                'description' => 'Menguruskan pentadbiran sistem.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pengurusan',
                'slug' => 'pengurus',
                'description' => 'Menentukan keputusan berdasarkan data akademik.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Analisis Data',
                'slug' => 'analisis-data',
                'description' => 'Menganalisis data akademik.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
