<?php

namespace Database\Seeders;

use App\Models\Winner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WinnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $winners = [
            [
                'id' => 1,
                'rifa_id' => 1,
                'award_id' => 1,
                'ticket_id' => 1,
            ]
        ];

        Winner::insert($winners);
    }
}
