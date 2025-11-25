<?php

namespace App\Http\Controllers\Api;

use App\Enums\InvoiceStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Get /api/invoices
     * Lista todas las facturas con paginación.
     */
    public function index()
    {
        $invoices = Invoice::with('invoiceDetails')
            ->latest()
            ->paginate(10);
        return InvoiceResource::collection($invoices);
    }
    /**
     * Get /api/invoices/{id}
     * Muestra una factura específica.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('invoiceDetails');
        return new InvoiceResource($invoice);
    }

    /**
     * Destroy /api/invoices/{id}
     * Anula una factura específica.
     */
    public function destroy(Invoice $invoice)
    {
        if ($invoice->status === InvoiceStatus::PAID) {
            return response()->json([
                'message' => 'No se puede anular una factura que ya ha sido pagada.'
            ], 422);
        }
        $invoice->delete();
        return response()->json([
                'message' => 'Factura anulada con exitó.'
            ], 200);
    }

}
