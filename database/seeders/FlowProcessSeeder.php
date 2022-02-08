<?php

namespace Database\Seeders;

use App\Models\FlowProcess;
use Illuminate\Database\Seeder;

class FlowProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FlowProcess::create([
            'no_drawing' => 'ASD-210101-R0',
            'process' => 'a:2:{i:0;a:2:{i:10;a:4:{s:9:"op_number";s:2:"10";s:11:"work_center";s:2:"SG";s:11:"description";s:6:"potong";s:10:"estimation";s:1:"5";}i:20;a:4:{s:9:"op_number";s:2:"20";s:11:"work_center";s:3:"BRZ";s:11:"description";s:7:"brazing";s:10:"estimation";s:2:"10";}}i:1;a:1:{i:10;a:4:{s:9:"op_number";s:2:"10";s:11:"work_center";s:2:"CG";s:11:"description";N;s:10:"estimation";s:2:"30";}}}'
        ]);
    }
}
