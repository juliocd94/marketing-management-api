<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'id' => 1,
                'plan_id' => 1,
                'name' => 'Rifas Vip Bailadores',
                'code' => 'jfb45r'
            ]
        ];

        Company::insert($companies);
    }
}
