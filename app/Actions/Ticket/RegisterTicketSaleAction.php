<?php

namespace App\Actions\Ticket;

namespace App\Actions\Ticket;

use App\Actions\Customer\CreateCustomerAction;
use App\Events\TicketSold;
use App\Models\Customer;
use App\Models\Ticket;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

readonly class RegisterTicketSaleAction
{
    public function __construct(private CreateCustomerAction $createCustomer)
    {
    }
    /**
     * @throws Exception
     */
    public function execute(array $validated, User $user): Ticket
    {
        DB::beginTransaction();

        try {
            $ticket = Ticket::where('customer_id', null)->findOrFail($validated['ticketId']);

            if ($validated['customerId']) {
                $customer = Customer::findOrFail($validated['customerId']);
                $customer->phone = $validated['customerPhone'];
                $customer->save();
            } else {
                $customer = $this->createCustomer->execute($validated, $user);
            }

            $ticket->customer_id = $customer->id;
            $ticket->save();

            event(new TicketSold($ticket));

            DB::commit();

            return $ticket;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

