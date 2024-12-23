<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $company = $request->user()->company;

        $rifa = $company->rifas()
            ->whereDate('init_date', '<=', now())
            ->whereDate('finish_date', '>=', now())
            ->first();

        if (!$rifa) {
            return response()->json([
                "status" => false,
                "message" => "No tiene una rifa activa o no pertenece a su compañía."
            ], 404);
        }

        $tickets = Ticket::with('customer')->where('rifa_id', $rifa->id)->get();

        return response()->json([
            "status" => true,
            "message" => "Tickets obtenidos exitosamente",
            "data" => $tickets
        ]);
    }

    public function getTicketsActiveProject(Request $request): JsonResponse
    {
        $company = $request->user()->company;

        $rifa = $company->rifas()
            ->whereDate('init_date', '<=', now())
            ->whereDate('finish_date', '>=', now())
            ->first();

        if (!$rifa) {
            return response()->json([
                "status" => false,
                "message" => "No tiene una rifa activa."
            ], 404);
        }

        $tickets = Ticket::with('customer')->where('rifa_id', $rifa->id)->get();


        if (!$tickets) {
            return response()->json([
                "status" => false,
                "message" => "No se encontraron un tickets."
            ], 404);
        }

        return response()->json([
            "status" => true,
            "message" => "Tickets obtenidos exitosamente",
            "data" => $tickets,
            "project" => $rifa
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function sold(Request $request): JsonResponse
    {
        $company = $request->user()->company;

        $rifa = $company->rifas()
            ->whereDate('init_date', '<=', now())
            ->whereDate('finish_date', '>=', now())
            ->first();

        if (!$rifa) {
            return response()->json([
                "status" => false,
                "message" => "No tiene una rifa activa."
            ], 404);
        }

        $tickets = Ticket::with('customer')
            ->where('rifa_id', $rifa->id)
            ->whereNotNull('customer_id')
            ->get();


        if (!$tickets) {
            return response()->json([
                "status" => false,
                "message" => "No se encontraron un tickets."
            ], 404);
        }

        return response()->json([
            "status" => true,
            "message" => "Tickets obtenidos exitosamente",
            "data" => $tickets,
            "project" => $rifa
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function unsold(Request $request): JsonResponse
    {
        $company = $request->user()->company;

        $rifa = $company->rifas()
            ->whereDate('init_date', '<=', now())
            ->whereDate('finish_date', '>=', now())
            ->first();

        if (!$rifa) {
            return response()->json([
                "status" => false,
                "message" => "No tiene una rifa activa."
            ], 404);
        }

        $tickets = Ticket::with('customer')
            ->where('rifa_id', $rifa->id)
            ->whereNull('customer_id')
            ->get();


        if (!$tickets) {
            return response()->json([
                "status" => false,
                "message" => "No se encontraron un tickets."
            ], 404);
        }

        return response()->json([
            "status" => true,
            "message" => "Tickets obtenidos exitosamente",
            "data" => $tickets,
            "project" => $rifa
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket): JsonResponse
    {
        $ticket = Ticket::with('customer')->with('payments')->with('rifa')->find($ticket->id);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket no encontrado'], 404);
        }

        $payments = Payment::where('ticket_id', $ticket->id)->get();

        $totalAbonado = Payment::where('ticket_id', $ticket->id)->sum('reference_value');

        $progress = ($totalAbonado / $ticket->rifa->ticket_price) * 100;

        return response()->json([
            "status" => true,
            "message" => "Ticket obtenido exitosamente",
            "data" => $ticket,
            "payments" => $payments
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }


    public function registreSell(Request $request)
//    public function registreSell(Request $request): JsonResponse|\Exception
    {
        $validated = $request->validate([
            'id' => 'nullable|int',
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'identification' => 'required|string|unique:customers,identification',
            'ticketId' => 'required|int',
        ]);

        $ticket = Ticket::find($validated['ticketId']);

        if (!is_null($ticket->customer_id)){
            return new \Exception('El ticket ya fue comprado por otro usuario');
        }

        $user = $request->user();
        $user = $user->load('company');

        if ($validated['id']){
            $customer = Customer::find($validated['id']);
            $customer->phone = $validated['phone'];
            $customer->save();
        }else{
            $customer = new Customer();
            $customer->company_id = $user->company->id;
            $customer->identification_type = "Cédula";
            $customer->identification = $validated['identification'];
            $customer->phone = $validated['phone'];
            $customer->address = $validated['address'];
            $customer->name = $validated['name'];
            $customer->save();
        }

        $ticket->customer_id = $customer->id;
        $ticket->save();

        return response()->json([
            "status" => true,
            "message" => "Ticket apartado exitosamente",
            "data" => $ticket->load('customer')
        ]);
    }
}
