<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'concept',
        'unit_price',
        'quantity',
        'subtotal',
        'tax',
        'total'
    ];
    protected $casts = [
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2'
    ];
    public function invoice(): BelongsTo{
        return $this->belongsTo(Invoice::class);
    }
}
