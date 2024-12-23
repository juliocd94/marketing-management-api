<?php

namespace Database\Seeders;

use App\Models\Raffle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RaffleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $raffles = [
            [
                'id' => 1,
                'lottery_variant_id' => 1,
                'draw_date' => '8/12/2025, 10:10pm',
                'winning_number' => "028"
            ],
            [
                'id' => 2,
                'lottery_variant_id' => 2,
                'draw_date' => '14/12/2025, 10:10pm',
                'winning_number' => "472"
            ],
        ];

        Raffle::insert($raffles);
    }
}
