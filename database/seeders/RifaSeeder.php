<?php

namespace Database\Seeders;

use App\Models\Rifa;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RifaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rifas = [
            [
                'id' => 1,
                'company_id' => 1,
                'name' => 'Rifa de fin de año',
                'description' => null,
                'quantity_tickets' => 1000,
                'currency' => 'USD',
                'ticket_price' => 25,
                'init_date' => Carbon::now(),
                'finish_date' => Carbon::now()->addMonth()->addDays(15)
            ]
        ];

        Rifa::insert($rifas);
    }
}
