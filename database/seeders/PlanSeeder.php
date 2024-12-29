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
                'cost' => 0,
                'code' => 'drt54h'
            ],
            [
                'id' => 2,
                'name' => 'Gestión',
                'description' => 'Plan intermedio',
                'cost' => 400.00,
                'code' => 'dlt39i'
            ],
            [
                'id' => 3,
                'name' => 'Plus',
                'description' => 'Plan plus',
                'cost' => 700.00,
                'code' => 'pkt13f'
            ]
        ];

        Plan::insert($plans);
    }
}
