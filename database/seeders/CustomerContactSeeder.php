<?php

namespace Database\Seeders;

use App\Models\CustomerContact;
use Illuminate\Database\Seeder;

class CustomerContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomerContact::create([
            'cust_code' => 'ASD',
            'name' => 'Orochimaru',
            'position' => 'owner',
            'email' => 'Orochimaru@asd.com',
            'phone' => '123,134'
        ]);

        CustomerContact::create([
            'cust_code' => 'ASD',
            'name' => 'Itachi',
            'position' => 'engineering',
            'email' => 'engineering@asd.com, eng@asd.com',
            'phone' => '12345,1349090'
        ]);

        CustomerContact::create([
            'cust_code' => 'XYZ',
            'name' => 'Jiraya',
            'position' => 'engineering',
            'phone' => '12345'
        ]);
    }
}
