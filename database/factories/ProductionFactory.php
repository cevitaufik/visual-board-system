<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'no_shop_order' => 211109002,
            'subprocess' => 0,
            'op' => 10,
            'quantity_start' => 5,
            'quantity_end' => 5,
            'work_center' => 'SG',
            'estimation' => 5,
            'start' => date("Y-m-d H:i:s"),
            'end' => date("Y-m-d H:i:s"),
            'start_by' => 'superadmin',
            'end_by' => 'superadmin',
        ];
    }
}
