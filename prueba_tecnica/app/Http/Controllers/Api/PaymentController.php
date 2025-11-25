<?php

namespace App\Http\Controllers\Api;

use App\Enums\InvoiceStatus;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class PaymentController extends Controller
{
    public function store(Invoice $invoice, Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);
        $amount = $validated['amount'];

        if ((float)$amount < (float)$invoice->total_amount) {
            return response()->json([
                'message' => 'Saldo insuficiente para realizar esta transacción'
            ], 422);
        }
        if ($invoice->status == InvoiceStatus::PAID) {
            return response()->json([
                'error' => 'Esta factura ya fue pagada.'
            ]);
        }
        try {
            $response = DB::transaction(function () use ($invoice, $amount) {
                Payment::create([
                    'invoice_id' => $invoice->id,
                    'paid_at' => now(),
                    'amount' => $amount,
                ]);
                $invoice->update([
                    'status' => InvoiceStatus::PAID,
                ]);
                return response()->json([
                    'message' => 'Factura pagada con exito',
                    'invoice_id' => $invoice->id
                ], 201);
            });
            return $response;
        } catch (\Exception $e) {
            return response()->json(
                ['message' => 'Errro al procesar el pago: ' . $e->getMessage()]
            );
        }
    }
}
