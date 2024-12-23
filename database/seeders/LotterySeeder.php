<?php

namespace Database\Seeders;

use App\Models\Lottery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LotterySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lotteries = [
            [
                'id' => 1,
                'company_id' => 1,
                'name' => 'Lotería del Táchira',
            ],
            [
                'id' => 2,
                'company_id' => 1,
                'name' => 'Lotería de Boyacá',
            ]
        ];

        Lottery::insert($lotteries);
    }
}
