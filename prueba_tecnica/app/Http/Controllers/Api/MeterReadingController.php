<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMeterReadingRequest;
use App\Models\Meter;
use App\Models\MeterReading;
use Illuminate\Http\Request;

class MeterReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMeterReadingRequest $request, Meter $meter)
    {
        $data = $request->validated();
        $lastReading = $meter->meterReadings()->latest('reading_date')->first();
        $previuos_value = $lastReading ? $lastReading->current_reading : 0;
        $currente_value = $data['current_reading'];
        if ($currente_value < $previuos_value) {
            return response()->json(['message' => 'La lectura no puede ser inferior a la anterior'],422);
        }
        $consumption = $currente_value - $previuos_value;
        MeterReading::create([
            'meter_id' => $meter->id,
            'reading_date' => $data['reading_date'],
            'previous_reading' => $previuos_value,
            'current_reading' => $currente_value,
            'consumption_m3' => $consumption,
            'observation' => $data['observation'] ?? null,
        ]);
        return response()->json(['message'=>'Lectura generada con exito'],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
