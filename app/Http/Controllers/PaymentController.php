<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Rifa;
use App\Models\Ticket;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function store(StorePaymentRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $currentUser = $request->user();

        DB::beginTransaction();

        try {
            $ticket = Ticket::findOrFail($validatedData['ticketId']);
            $rifa = Rifa::where('company_id', $currentUser->company->id)
                ->findOrFail($ticket->rifa_id);
            $customer = Customer::findOrFail($ticket->customer_id);

            $previousPaymentsSum = Payment::where('ticket_id', $ticket->id)->sum('reference_value');
            $currentPaymentAmount = $validatedData['referenceValue'];
            $totalPaid = $previousPaymentsSum + $currentPaymentAmount;
            $paymentProgress = round(($totalPaid / $ticket->rifa->ticket_price) * 100);

            $ticket->update([
                'payment_progress' => $paymentProgress,
                'total_paid' => $totalPaid,
            ]);

            $payment = Payment::create([
                'ticket_id' => $ticket->id,
                'rifa_id' => $rifa->id,
                'customer_id' => $customer->id,
                'reference_value' => $currentPaymentAmount,
                'amount' => $validatedData['amount'],
                'date' => $validatedData['date'],
                'currency' => $validatedData['currency'],
                'payment_method' => $validatedData['paymentMethod'],
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Pago registrado exitosamente',
                'data' => $payment,
            ], 201);
        } catch (Exception $exception) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Error al registrar el pago',
                'error' => $exception->getMessage(),
            ], 500);
        }
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
