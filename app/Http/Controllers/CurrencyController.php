<?php

namespace App\Http\Controllers;

use App\Enums\Currency;
use Illuminate\Http\JsonResponse;

class CurrencyController extends Controller
{
    /**
     * Get the list of currencies.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Currency::all(),
        ]);
    }
}
