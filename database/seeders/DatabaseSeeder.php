<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'super admin',
            'username' => 'superadmin',
            'position' => 'superadmin',
            'access' => ['all'],
            'email' => 'superadmin@gmail.com',
            'phone' => '08123123123',
            'address' => 'Jawa barat, Indonesia',
            'about' => 'Saya super admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => true,
        ]);

        User::create([
            'name' => 'engineering',
            'username' => 'engineering',
            'position' => 'engineering',
            'email' => 'engineering@gmail.com',
            'phone' => '08123123124',
            'address' => 'Jakarta, Indonesia',
            'about' => 'Ini adalah akun engineering',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => true,
        ]);

        User::create([
            'name' => 'operator',
            'username' => 'operator',
            'position' => 'operator',
            'email' => 'operator@gmail.com',
            'phone' => '08123123122',
            'address' => 'Tangerang, Indonesia',
            'about' => 'Ini adalah akun operator pertama',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => true,
        ]);
    }
}
