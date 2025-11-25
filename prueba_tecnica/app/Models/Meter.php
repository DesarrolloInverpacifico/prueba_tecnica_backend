<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meter extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'serial_number',
        'installation_date',
        'status'
    ];
    protected $casts = [
        'installation_date' => 'date',
    ];
    public function customer(): BelongsTo{
        return $this->belongsTo(Customer::class);
    }
    public function meterReadings(): HasMany{
         return $this->hasMany(MeterReading::class);
    }
}
