<?php

namespace Database\Seeders;

use App\Models\Award;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $awards = [
            [
                'id' => 1,
                'rifa_id' => 1,
                'description' => '2000$',
                'lottery' => 'Táchira triple A',
                'draw_date' => Carbon::now()->addHour(),
                'status' => 1,
            ]
        ];

        Award::insert($awards);
    }
}
