<?php

namespace App\Http\Controllers;

use App\Enums\PaymentMethod;
use Illuminate\Http\JsonResponse;

class PaymentMethodController extends Controller
{
    /**
     * Get the list of payment methods.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'Métodos de pago obtenidos exitosamente',
            'data' => PaymentMethod::all(),
        ]);
    }
}
