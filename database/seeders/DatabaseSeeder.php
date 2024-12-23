<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PlanSeeder::class,
            CompanySeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            RifaSeeder::class,
            TicketSeeder::class,
            AwardSeeder::class,
            WinnerSeeder::class,
            LotterySeeder::class,
            LotteryVariantSeeder::class,
            RaffleSeeder::class
        ]);
    }
}
