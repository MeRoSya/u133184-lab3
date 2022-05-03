<?php

namespace App\Http\ApiV1\Addresses\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressSubResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'city' => $this->city,
            'street' => $this->street,
            'building' => $this->building,
            'floor' => $this->floor,
            'flat' => $this->flat
        ];
    }
}
