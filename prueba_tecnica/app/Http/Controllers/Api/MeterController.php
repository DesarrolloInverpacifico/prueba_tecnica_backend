<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMeterRequest;
use App\Http\Requests\UpdateMeterRequest;
use App\Http\Resources\MeterResource;
use App\Models\Meter;
use Exception;
use Illuminate\Http\Request;

class MeterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meters = Meter::with('meterReadings')
            ->latest()
            ->paginate(10);
        return MeterResource::collection($meters);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMeterRequest $request)
    {
        try {
            $meter = Meter::create($request->validated());
            return response()->json([
                'message' => 'Medidor registrado con exito',
                'data' => $meter
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ocurrio un error al registrar el medidor: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Meter $meter)
    {
        $meter->load('meterReadings');
        return new MeterResource($meter);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMeterRequest $request, Meter $meter)
    {
        try{
            $meter->update($request->validated());
            return response()->json([
            'message' => 'Medidor actualizado',
            'data' => $meter
        ],201);

        }catch (Exception $e) {
            return response()->json([
                'message' => 'Ocurrio un error al actualizar el medidor: ' . $e->getMessage()
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meter $meter)
    {
        $meter->update(['status' => 'inactive']);
        return response()->json([
            'message' => 'Medidor inactivado correctamente'
        ]);
    }
}
