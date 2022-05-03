<?php

namespace App\Http\ApiV1\Addresses\Resources;

use App\Domain\Addresses\Models\Address;
use Illuminate\Http\Resources\Json\JsonResource;

/** 
 * Used when address should be inserted in another object 
 * @mixin Address 
 * */
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
