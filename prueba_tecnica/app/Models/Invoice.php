<?php

namespace App\Models;

use App\Enums\InvoiceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'invoice_number',
        'customer_id',
        'billing_period_start',
        'billing_period_end',
        'issue_date',
        'due_date',
        'status',
        'total_amount'
    ];
    protected $casts = [
        'billing_period_start' => 'date',
        'billing_period_end' => 'date',
        'issue_date' => 'date',
        'due_date' => 'date',
        'total_amount' => 'decimal:2',
        'status' => InvoiceStatus::class,
    ];
    public function customer(): BelongsTo{
        return $this->belongsTo(Customer::class);
    }
    public function invoiceDetails(): HasMany{
        return $this->hasMany(InvoiceDetail::class);
    }
    public function payment(): HasMany{
        return $this->hasMany(Payment::class);
    }
}
