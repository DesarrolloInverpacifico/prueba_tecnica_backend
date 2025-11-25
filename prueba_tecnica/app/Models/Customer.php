<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'last_name',
        'identification_number',
        'email',
        'address',
    ];
    public function meters(): HasMany{
        return $this->hasMany(Meter::class);
    }
    public function invoices(): HasMany{
        return $this->hasMany(Invoice::class);
    }
}
