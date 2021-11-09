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
            'shop_order' => 211109006,
            'cust_code' => 'ABC',
            'description' => 'pekerjaan pertama',
            'tool_code' => 'TOOL-1',
            'quantity' => 5,
            'dwg_number' => 'ABC-211101-R0',
            'job_type' => 'NEW',
            'due_date' => '2021-11-30'
        ]);

        Order::create([
            'po_number' => 'PO2021-002',
            'shop_order' => 211109007,
            'cust_code' => 'ABD',
            'description' => 'pekerjaan pertama',
            'tool_code' => 'TOOL-2',
            'quantity' => 5,
            'dwg_number' => 'ABD-211101-R0',
            'job_type' => 'NEW',
            'due_date' => '2021-11-30'
        ]);

        Order::create([
            'po_number' => 'PO2021-012',
            'shop_order' => 211109008,
            'cust_code' => 'XYZ',
            'description' => 'pekerjaan pertama',
            'tool_code' => 'TOOL-123',
            'quantity' => 5,
            'dwg_number' => 'XYZ-201101-R1',
            'job_type' => 'REG',
            'due_date' => '2021-11-30'
        ]);
    }
}
