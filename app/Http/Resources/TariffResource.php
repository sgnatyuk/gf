<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// Helpers
use App\Helpers\Currency;

class TariffResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'description'   => $this->description,
            'price'         => $this->price,
            'disabled_days' => $this->disabled_days,
        ];
    }
}
