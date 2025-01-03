<?php

namespace App\Http\Controllers;

use App\Enums\Lottery;
use Illuminate\Http\JsonResponse;

class LotteryController extends Controller
{
    /**
     * Get the list of lotteries.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Lottery::all(),
        ]);
    }
}
