<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\FlowProcess;
use App\Models\User;
use App\Models\Order;
use App\Models\JobType;
use App\Models\Production;
use App\Models\Tool;
use App\Models\WorkCenter;
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
        Production::factory(50)->create();
        
        // ===============================================================================
        // user seed

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

        // ===============================================================================
        // job type

        JobType::create([
            'code' => 'NEW',
            'description' => 'Buat baru',
        ]);

        JobType::create([
            'code' => 'REG',
            'description' => 'Regrinding',
        ]);

        JobType::create([
            'code' => 'RET',
            'description' => 'Retyping',
        ]);

        JobType::create([
            'code' => 'REP',
            'description' => 'Repair',
        ]);

        JobType::create([
            'code' => 'MOD',
            'description' => 'Modifikasi',
        ]);

        // ===============================================================================
        // tool

        Tool::create([
            'cust_code' => 'ASD',
            'code' => 'ASD-1',
            'description' => 'tool nomor 1 ASD',
            'drawing' => 'ASD-210101-R0',
            'status' => 'PRODUCTION',
        ]);

        Tool::create([
            'cust_code' => 'ABC',
            'code' => 'ABC-1',
            'description' => 'tool nomor 1',
            'drawing' => 'ABC-210101-R0',
            'status' => 'PRODUCTION',
        ]);

        Tool::create([
            'cust_code' => 'XYZ',
            'code' => 'XYZ-1',
            'description' => 'tool nomor 1 XYZ',
            'drawing' => 'XYZ-210101-R0',
            'status' => 'PRODUCTION',
        ]);

        Tool::create([
            'cust_code' => 'ABC',
            'code' => 'ABC-2',
            'description' => 'tool nomor 2',
            'drawing' => 'ABC-210102-R0',
            'status' => 'TIDAK DIGUNAKAN',
        ]);

        Tool::create([
            'cust_code' => 'ABC',
            'code' => 'ABC-2',
            'description' => 'tool nomor 2',
            'drawing' => 'ABC-210102-R1',
            'status' => 'PRODUCTION',
        ]);

        Tool::create([
            'cust_code' => 'ABC',
            'code' => 'ABC-2',
            'description' => 'tool nomor 2',
            'drawing' => 'ABC-210102-R2',
            'status' => 'PRODUCTION',
        ]);


        Tool::create([
            'cust_code' => 'MNO',
            'code' => 'MNO-1',
            'description' => 'tool nomor 1 MNO',
            'drawing' => 'MNO-210101-R0',
            'status' => 'APPROVAL CUST.',
        ]); 

        Tool::create([
            'cust_code' => 'MNO',
            'code' => 'MNO-1',
            'description' => 'tool nomor 1 MNO',
            'drawing' => 'MNO-210101-R1',
            'status' => 'APPROVED',
        ]);

        // ===============================================================================
        // work center

        WorkCenter::create([
            'code' => 'SG',
            'description' => 'Surface Grinding',
        ]);

        WorkCenter::create([
            'code' => 'BRZ',
            'description' => 'Brazing',
        ]);

        WorkCenter::create([
            'code' => 'TR',
            'description' => 'Turning',
        ]);

        WorkCenter::create([
            'code' => 'CG',
            'description' => 'Cylindrical grinding',
        ]);

        // ===============================================================================
        // flow process

        // FlowProcess::create([
        //     'no_drawing' => 'ASD-210101-R0',            
        //     'op_number' => 10,
        //     'work_center' => 'SG',
        //     'description' => 'potong material',
        //     'estimation' => 10,
        // ]);

        // FlowProcess::create([
        //     'no_drawing' => 'ASD-210101-R0',            
        //     'op_number' => 20,
        //     'work_center' => 'BRZ',
        //     'description' => 'brazing center bantu',
        //     'estimation' => 10,
        // ]);

        // FlowProcess::create([
        //     'no_drawing' => 'ASD-210101-R0',            
        //     'op_number' => 30,
        //     'work_center' => 'TR',
        //     'description' => 'center bantu',
        //     'estimation' => 10,
        // ]);

        // FlowProcess::create([
        //     'no_drawing' => 'ASD-210101-R0',            
        //     'op_number' => 40,
        //     'work_center' => 'CG',
        //     'estimation' => 10,
        // ]);

        // FlowProcess::create([
        //     'no_drawing' => 'ASD-210101-R0',            
        //     'op_number' => 50,
        //     'work_center' => 'UG',
        //     'description' => 'potong center bantu',
        //     'estimation' => 10,
        // ]);

        // FlowProcess::create([
        //     'no_drawing' => 'ABC-210102-R2',            
        //     'op_number' => 10,
        //     'work_center' => 'SG',
        //     'description' => 'potong material',
        //     'estimation' => 10,
        // ]);

        // FlowProcess::create([
        //     'no_drawing' => 'ABC-210102-R2',            
        //     'op_number' => 20,
        //     'work_center' => 'BRZ',
        //     'description' => 'brazing center bantu',
        //     'estimation' => 10,
        // ]);

        // ===============================================================================
        // order

        Order::create([
            'po_number' => 'PO2021-001',
            'shop_order' => 211109002,
            'cust_code' => 'ASD',
            'description' => 'pekerjaan pertama',
            'tool_code' => 'ASD-1',
            'quantity' => 5,
            'no_drawing' => 'ASD-210101-R0',
            'job_type_code' => 'NEW',
            'due_date' => '2021-11-30',
            'note' => 'catatan',
        ]);

        Order::create([
            'po_number' => 'PO2021-001',
            'shop_order' => 211109006,
            'cust_code' => 'ABC',
            'description' => 'pekerjaan pertama',
            'tool_code' => 'ABC-1',
            'quantity' => 5,
            'no_drawing' => 'ABC-210101-R0',
            'job_type_code' => 'NEW',
            'due_date' => '2021-11-30',
            'note' => 'catatan',
        ]);

        Order::create([
            'po_number' => 'PO2021-002',
            'shop_order' => 211109003,
            'cust_code' => 'MNO',
            'description' => 'pekerjaan pertama',
            'tool_code' => 'MNO-2',
            'quantity' => 5,
            'no_drawing' => 'MNO-210101-R0',
            'current_process' => 'prod',
            'job_type_code' => 'NEW',
            'due_date' => '2021-11-30',
            'note' => 'catatan',
        ]);

        Order::create([
            'po_number' => 'PO2021-012',
            'shop_order' => 211109004,
            'cust_code' => 'XYZ',
            'description' => 'pekerjaan pertama',
            'tool_code' => 'XYZ-123',
            'quantity' => 5,
            'current_process' => 'eng',
            'job_type_code' => 'NEW',
            'due_date' => '2021-11-30',
            'note' => 'catatan'
        ]);

        Order::create([
            'po_number' => 'PO2021-012',
            'shop_order' => 211109005,
            'cust_code' => 'XYZ',
            'description' => 'pekerjaan pertama',
            'tool_code' => 'XYZ-123',
            'quantity' => 5,
            'current_process' => 'close',
            'job_type_code' => 'NEW',
            'due_date' => '2021-11-30',
            'note' => 'catatan',
        ]);
        
        Customer::create([
            'code' => 'XYX',
            'name' => 'Xyzabc',
            'address' => 'bekasi',
            'email' => 'xyz@gmail.com',
            'phone' => '123123123',
        ]);

        Customer::create([
            'code' => 'ASD',
            'name' => 'Asdabc',
            'address' => 'bekasi',
            'email' => 'asd@gmail.com',
            'phone' => '1231231231',
        ]);

        Customer::create([
            'code' => 'MNO',
            'name' => 'Mnoabc',
            'address' => 'bekasi',
            'email' => 'mno@gmail.com',
            'phone' => '1231231232',
        ]);
    }
}
