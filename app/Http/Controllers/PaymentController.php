<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Rifa;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'referenceValue' => 'required|numeric|min:0',
            'date' => 'required|date',
            'currency' => 'required|string|max:10',
            'ticketId' => 'required|string|max:50',
            'paymentMethod' => 'required|string|max:50',
        ]);

        $user = $request->user();
        $ticket = Ticket::find($validated['ticketId']);
        $rifa = Rifa::where('company_id', $user->company->id)->find($ticket->rifa_id);
        $customer = Customer::find($ticket->customer_id);

        $total_paid = Payment::where('ticket_id', $ticket->id)->sum('reference_value');
        $total_paid2 = $validated['amount'];
        $progress = round(($total_paid2 / $ticket->rifa->ticket_price) * 100);
        $ticket->payment_progress = $progress;
        $ticket->total_paid = $total_paid2;
        $ticket->save();

        $payment = new Payment();
        $payment->ticket_id = $validated['ticketId'];
        $payment->rifa_id = $rifa->id;
        $payment->customer_id = $customer->id;
        $payment->reference_value = $validated['referenceValue'];
        $payment->amount = $validated['amount'];
        $payment->date = $validated['date'];
        $payment->currency = $validated['currency'];
        $payment->payment_method = $validated['paymentMethod'];
        $payment->save();

        return response()->json([
            'status' => true,
            'message' => 'Pago registrado exitosamente',
            'data' => $payment,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
