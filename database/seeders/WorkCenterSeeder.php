<?php

namespace Database\Seeders;

use App\Models\WorkCenter;
use Illuminate\Database\Seeder;

class WorkCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
