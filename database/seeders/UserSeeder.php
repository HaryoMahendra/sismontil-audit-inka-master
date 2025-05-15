<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::updateOrCreate([
        //     'name' => "Admin1",
        //     'role_id' => "1",
        //     'departement_id' => "",
        //     'username' => "Admin1",
        //     'email' => "admin1@gmail.com",
        //     'password' => Hash::make('123'),
        // ]);
        // User::updateOrCreate([
        //     'name' => "Auditor1",
        //     'role_id' => "2",
        //     'departement_id' => "",
        //     'username' => "Auditor1",
        //     'email' => "auditor1@gmail.com",
        //     'password' => Hash::make('123'),
        // ]);
        // User::updateOrCreate([
        //     'name' => "Auditee1",
        //     'role_id' => "3",
        //     'departement_id' => "",
        //     'username' => "Auditee1",
        //     'email' => "auditee1@gmail.com",
        //     'password' => Hash::make('123'),
        // ]);
        // User::updateOrCreate([
        //     'name' => "Verifikator1",
        //     'role_id' => "4",
        //     'departement_id' => "",
        //     'username' => "Verifikator1",
        //     'email' => "verifikator1@gmail.com",
        //     'password' => Hash::make('123'),
        // ]);
        // User::updateOrCreate([
        //     'name' => 'auditor',
        //     'role_id' => 'auditor',
        //     'username' => 'auditor',
        //     'email' => 'auditor@gmail.com',
        //     'password' => Hash::make('123'),
        // ]);
        // User::updateOrCreate([
        //     'name' => 'hukum',
        //     'role_id' => 'auditee',
        //     'username' => 'hukum',
        //     'departement_id' => '1',
        //     'email' => 'hukum@gmail.com',
        //     'password' => Hash::make('123'),
        // ]);
        
        User::updateOrCreate([
            'name' => 'Wakil Manajemen1',
            'role_id' => '4',
            'username' => 'wakilmanajemen1',
            'email' => 'wakilmanajemen@gmail.com',
            'password' => Hash::make('123'),
        ]);

        User::where('username', 'wakil manajemen')->update([
            'username' => 'wakilmanajemen1'
        ]);

        
    }
}
