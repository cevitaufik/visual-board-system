<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

    }
}
