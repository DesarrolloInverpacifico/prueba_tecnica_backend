<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceGeneratorReadingRequest;
use App\Http\Requests\StoreInvoiceGeneratorRequest;
use App\Models\Customer;
use App\Services\BillingService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class InvoiceGeneratorController extends Controller
{
    public function store(StoreInvoiceGeneratorRequest $request, BillingService $billingService)
    {
        $validated = $request->validated();
        $customer = Customer::findOrFail($validated['customer_id']);
        $date = Carbon::parse($validated['billing_date']);

        try {
            $invoice = $billingService->generateInvoiceForPeriod($customer,$date);
            if(!$invoice){
                return response()->json([
                    'message' => 'No se pudo generar la factura, revisa que el cliente tenga un medidor activo y lecturas registradas para esa fecha'
                ],422);
            }
            return response()->json([
                'message' => 'Factura registrada con exito',
                'data' => $invoice
            ],201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al momento de realizar la factura: ' . $e->getMessage()
            ],500);
        }
    }
}
