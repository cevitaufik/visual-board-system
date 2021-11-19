<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
