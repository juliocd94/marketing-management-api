<?php

namespace App\Actions\Rifa;

use App\Models\Rifa;
use App\Models\Award;
use App\Models\Ticket;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateRifaAction
{
    public function execute(array $validated, $user): Rifa
    {
        DB::beginTransaction();

        try {
            $rifa = Rifa::create([
                'company_id' => $user->company->id,
                'name' => $validated['name'],
                'description' => $validated['description'],
                'init_date' => $validated['initDate'],
                'finish_date' => $validated['finishDate'],
                'currency' => $validated['currency'],
                'quantity_tickets' => $validated['quantityTickets'],
                'ticket_price' => $validated['price'],
            ]);

            $awards = [];
            foreach ($validated['awards'] as $item) {
                $awards[] = [
                    'rifa_id' => $rifa->id,
                    'description' => $item['description'],
                    'lottery' => $item['lottery'],
                    'draw_date' => $item['drawDate'],
                    'status' => 'Programado',
                ];
            }
            Award::insert($awards);

            $tickets = [];
            for ($i = 0; $i < $rifa->quantity_tickets; $i++) {
                $tickets[] = [
                    'rifa_id' => $rifa->id,
                    'customer_id' => null,
                    'number' => str_pad($i, 3, '0', STR_PAD_LEFT),
                ];
            }
            Ticket::insert($tickets);

            DB::commit();

            return $rifa;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

