<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeterReadingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reading_date' => $this->reading_date,
            'previous_reading' => $this->previous_reading,
            'current_reading' => $this->current_reading,
            'consumption_m3' => (float) $this->consumption_m3,
            'observation' => $this->observation,
        ];
    }
}
