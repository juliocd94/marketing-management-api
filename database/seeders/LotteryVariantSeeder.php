<?php

namespace Database\Seeders;

use App\Models\LotteryVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LotteryVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lottery_variants = [
            [
                'id' => 1,
                'lottery_id' => 1,
                'name' => 'Triple A',
            ],
            [
                'id' => 2,
                'lottery_id' => 1,
                'name' => 'Triple B',
            ],
            [
                'id' => 3,
                'lottery_id' => 1,
                'name' => 'Triple Zodiacal',
            ]
        ];

        LotteryVariant::insert($lottery_variants);
    }
}
