<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
