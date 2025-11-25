<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeterResource extends JsonResource
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
            'customer_id' => $this->customer_id,
            'serial_number' => $this->serial_number,
            'installation_date' => $this->installation_date,
            'status' => $this->status,
            'readings' => MeterReadingResource::collection($this->meterReadings),
        ];
    }
}
