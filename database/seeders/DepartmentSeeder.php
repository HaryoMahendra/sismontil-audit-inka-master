<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('departemen')->insert([
            ['div_name' => 'QMSHE', 'created_at' => now(), 'updated_at' => now()],
            ['div_name' => 'Hukum', 'created_at' => now(), 'updated_at' => now()],
            ['div_name' => 'Teknologi', 'created_at' => now(), 'updated_at' => now()],
            ['div_name' => 'Keuangan', 'created_at' => now(), 'updated_at' => now()],
            ['div_name' => 'Sumber Daya Manusia', 'created_at' => now(), 'updated_at' => now()], 
        ]);
    }
}
