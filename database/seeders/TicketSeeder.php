<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Customer;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 1000; $i++) {
            Ticket::create([
                'rifa_id' => 1,
                'number' => str_pad($i, 3, '0', STR_PAD_LEFT),
                'customer_id' => null,
            ]);
        }

        $tickets = Ticket::inRandomOrder()->take(400)->get();

        $customers = Customer::all();

        foreach ($tickets as $ticket) {
            $ticket->update([
                'customer_id' => $customers->random()->id,
            ]);
        }
    }
}
