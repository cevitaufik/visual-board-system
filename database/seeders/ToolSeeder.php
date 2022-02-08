<?php

namespace Database\Seeders;

use App\Models\Tool;
use Illuminate\Database\Seeder;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
