<?php

namespace App\Http\Controllers;

use App\Actions\Customer\CreateCustomerAction;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $customers = Customer::all();

        return response()->json([
            "status" => true,
            "message" => "Clientes obtenidos exitosamente",
            "data" => $customers
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
    public function store(StoreCustomerRequest $request, CreateCustomerAction $createCustomer): JsonResponse
    {
        $validated = $request->validated();

        $user = $request->user();

        $customer = $createCustomer->execute($validated, $user);

        return response()->json([
            "status" => true,
            "message" => "Cliente creado exitosamente",
            "data" => $customer
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function search($identification)
    {
        if (empty($identification)) {
            return response()->json([
                'success' => false,
                'message' => 'El campo de identificación no puede estar vacío.',
            ], 400);
        }

        $customers = Customer::where('identification', 'LIKE', "%{$identification}%")->get();

        if ($customers->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No se encontraron clientes que coincidan con la búsqueda.',
                'customers' => [],
            ]);
        }

        return response()->json([
            'success' => true,
            'customers' => $customers,
        ]);
    }
}
