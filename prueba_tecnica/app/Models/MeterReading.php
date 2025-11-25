<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeterReading extends Model
{
    use HasFactory;
    protected $fillable = [
        'meter_id',
        'reading_date',
        'previous_reading',
        'current_reading',
        'consumption_m3',
        'observation',
    ];
    protected $casts = [
        'reading_date' => 'date',
        'previous_reading' => 'decimal:2',
        'current_reading' => 'decimal:2',
        'comsuption_m3' => 'decimal:2',
    ];
    public function meter(): BelongsTo
    {
        return $this->belongsTo(Meter::class);
    }
}
