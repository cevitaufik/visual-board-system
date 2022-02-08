<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Production;
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
        Production::factory(50)
                    ->sequence(
                        ['end_by' => 'engineering'],
                        ['end_by' => 'superadmin'],
                        ['end_by' => 'operator'])
                    ->create();
        
        User::factory(10)
                ->count(10)
                ->sequence(function ($sequence) {                    
                    switch ($sequence->index) {
                        case 0:
                            return
                            [
                                'username' => 'superadmin',
                                'position' => 'superadmin',
                                'profile_img' => 'profile_image/superadmin.jpg',
                            ];
                            break;
                        case 1:
                            return
                            [
                                'username' => 'engineering',
                                'position' => 'engineering',
                                'profile_img' => 'profile_image/engineering.jpg',
                            ];
                            break;
                        case 2:
                            return
                            [
                                'username' => 'marketing',
                                'position' => 'marketing',
                                'profile_img' => 'profile_image/marketing.jpg',
                            ];
                            break;
                        case 3:
                            return
                            [
                                'username' => 'ppic',
                                'position' => 'ppic',
                                'profile_img' => 'profile_image/ppic.jpg',
                            ];
                            break;
                        case 4:
                            return
                            [
                                'username' => 'operator',
                                'position' => 'operator',
                            ];
                            break;
                        default:
                            return
                            ['position' => 'operator'];
                    }

                })
                ->create();
        
        $workCenterSeeder = new WorkCenterSeeder();
        $workCenterSeeder->run();

        $jobTypeSeeder = new JobTypeSeeder();
        $jobTypeSeeder->run();

        $toolSeeder = new ToolSeeder();
        $toolSeeder->run();

        $orderSeeder = new OrderSeeder();
        $orderSeeder->run();

        $customerSeeder = new CustomerSeeder();
        $customerSeeder->run();
        
        $customerContactSeeder = new CustomerContactSeeder();
        $customerContactSeeder->run();

        $flowProcessSeeder = new FlowProcessSeeder();
        $flowProcessSeeder->run();
    }
}
