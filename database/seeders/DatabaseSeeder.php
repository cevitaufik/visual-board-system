<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
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
            'name' => 'marketing',
            'username' => 'marketing',
            'position' => 'marketing',
            'email' => 'marketing@gmail.com',
            'phone' => '08123123122',
            'address' => 'Tangerang, Indonesia',
            'about' => 'Ini adalah akun marketing pertama',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => true,
        ]);

        User::create([
            'name' => 'ppic',
            'username' => 'ppic',
            'position' => 'ppic',
            'email' => 'ppic@gmail.com',
            'phone' => '08123123125',
            'address' => 'Tangerang, Indonesia',
            'about' => 'Ini adalah akun ppic pertama',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => true,
        ]);

        User::create([
            'name' => 'operator',
            'username' => 'operator',
            'position' => 'operator',
            'email' => 'operator@gmail.com',
            'phone' => '08123123126',
            'address' => 'Tangerang, Indonesia',
            'about' => 'Ini adalah akun operator pertama',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => true,
        ]);

        Order::create([
            'po_number' => 'PO2021-001',
            'shop_order' => 211109002,
            'cust_code' => 'ABC',
            'description' => 'pekerjaan pertama',
            'tool_code' => 'TOOL-1',
            'quantity' => 5,
            'dwg_number' => 'ABC-211101-R0',
            'job_type' => 'NEW',
            'due_date' => '2021-11-30',
            'note' => 'catatan',
        ]);

        Order::create([
            'po_number' => 'PO2021-002',
            'shop_order' => 211109003,
            'cust_code' => 'ABD',
            'description' => 'pekerjaan pertama',
            'tool_code' => 'TOOL-2',
            'quantity' => 5,
            'dwg_number' => 'ABD-211101-R0',
            'current_process' => 'prod',
            'job_type' => 'NEW',
            'due_date' => '2021-11-30',
            'note' => 'catatan',
        ]);

        Order::create([
            'po_number' => 'PO2021-012',
            'shop_order' => 211109004,
            'cust_code' => 'XYZ',
            'description' => 'pekerjaan pertama',
            'tool_code' => 'TOOL-123',
            'quantity' => 5,
            'dwg_number' => 'XYZ-201101-R1',
            'current_process' => 'eng',
            'job_type' => 'REG',
            'due_date' => '2021-11-30',
            'note' => 'catatan'
        ]);

        Order::create([
            'po_number' => 'PO2021-012',
            'shop_order' => 211109005,
            'cust_code' => 'XYZ',
            'description' => 'pekerjaan pertama',
            'tool_code' => 'TOOL-123',
            'quantity' => 5,
            'dwg_number' => 'XYZ-201101-R1',
            'current_process' => 'close',
            'job_type' => 'REG',
            'due_date' => '2021-11-30',
            'note' => 'catatan',
        ]);
    }
}
