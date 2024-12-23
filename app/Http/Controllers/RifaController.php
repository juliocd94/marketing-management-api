<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Rifa;
use App\Models\Ticket;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RifaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $rifas = Rifa::with('awards')->where('company_id', $user->company->id)->get();

        return response()->json([
            "status" => true,
            "message" => "Proyectos obtenidos exitosamente",
            "data" => $rifas
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
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'string',
            'quantityTickets' => 'required|int',
            'currency' => 'required|string',
            'price' => 'required|numeric',
            'awards' => 'required|array',
            'initDate' => 'date',
            'finishDate' => 'date'
        ]);

        $user = $request->user();

        $rifa = new Rifa();
        $rifa->company_id = $user->company->id;
        $rifa->name = $validated['name'];
        $rifa->description = $validated['description'];
        $rifa->init_date = $validated['initDate'];
        $rifa->finish_date = $validated['finishDate'];
        $rifa->currency = $validated['currency'];
        $rifa->quantity_tickets = $validated['quantityTickets'];
        $rifa->ticket_price = $validated['price'];
        $rifa->save();

        foreach ($validated['awards'] as $item){
            $award = new Award();
            $award->rifa_id = $rifa->id;
            $award->description = $item['description'];
            $award->lottery = $item['lottery'];
            $award->draw_date = $item['drawDate'];
            $award->status = "Programado";
            $award->save();
        }

        for ($i = 0; $i < $rifa->quantity_tickets; $i++) {
            Ticket::create([
                'rifa_id' => $rifa->id,
                'customer_id' => null,
                'number' => str_pad($i, 3, '0', STR_PAD_LEFT)
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "Proyecto creado exitosamente",
            "data" => $rifa->load('awards')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rifa $rifa): JsonResponse
    {
        return response()->json([
            "status" => true,
            "message" => "Proyecto obtenido exitosamente",
            "data" => $rifa->load('awards')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rifa $rifa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rifa $rifa): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'quantityTickets' => 'required|int',
            'currency' => 'required|string',
            'price' => 'required|numeric',
            'awards' => 'required|array',
            'awards.*.id' => 'nullable|int|exists:awards,id',
            'awards.*.description' => 'required|string',
            'awards.*.lottery' => 'required|string',
            'awards.*.drawDate' => 'required|date',
            'initDate' => 'nullable|date',
            'finishDate' => 'nullable|date'
        ]);

        $rifa->name = $validated['name'];
        $rifa->description = $validated['description'];
        $rifa->init_date = $validated['initDate'];
        $rifa->finish_date = $validated['finishDate'];
        $rifa->currency = $validated['currency'];
        $rifa->quantity_tickets = $validated['quantityTickets'];
        $rifa->ticket_price = $validated['price'];
        $rifa->save();

        $frontendAwardIds = collect($validated['awards'])->pluck('id')->filter();

        $rifa->awards()->whereNotIn('id', $frontendAwardIds)->delete();

        foreach ($validated['awards'] as $item) {
            if (isset($item['id'])) {
                $award = Award::find($item['id']);
                $award->description = $item['description'];
                $award->lottery = $item['lottery'];
                $award->draw_date = $item['drawDate'];
                $award->save();
            } else {
                $award = new Award();
                $award->rifa_id = $rifa->id;
                $award->description = $item['description'];
                $award->lottery = $item['lottery'];
                $award->draw_date = $item['drawDate'];
                $award->status = "Programado";
                $award->save();
            }
        }

        return response()->json([
            "status" => true,
            "message" => "Proyecto actualizado exitosamente",
            "data" => $rifa->load('awards')
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rifa $rifa): JsonResponse
    {
        DB::beginTransaction();

        try {
            $rifa->awards()->delete();

            $rifa->delete();

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Rifa eliminada exitosamente.",
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => "Ocurrió un error al intentar eliminar la rifa.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
