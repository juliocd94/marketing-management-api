<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'id' => 1,
                'name' => 'Free',
                'description' => 'Plan gratis',
                'cost' => 0
            ],
            [
                'id' => 2,
                'name' => 'Intermedio',
                'description' => 'Plan intermedio',
                'cost' => 400.00
            ],
            [
                'id' => 3,
                'name' => 'Plus',
                'description' => 'Plan plus',
                'cost' => 700.00
            ]
        ];

        Plan::insert($plans);
    }
}
