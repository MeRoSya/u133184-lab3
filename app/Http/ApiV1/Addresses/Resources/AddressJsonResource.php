<?php

namespace App\Http\ApiV1\Addresses\Resources;

use App\Http\ApiV1\Common\Resources\CommonJsonResource;
use App\Http\ApiV1\Customers\Resources\CustomerSubResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Domain\Addresses\Models\Address;

/** @mixin Address */
class AddressJsonResource extends CommonJsonResource
{
    public function toArray($request)
    {
        $toReturn = parent::toArray($request);
        $toReturn['data'] = [
            'id' => $this->id,
            'customer' => new CustomerSubResource($this->customer),
            'city' => $this->city,
            'street' => $this->street,
            'building' => $this->building,
            'floor' => $this->floor,
            'flat' => $this->flat
        ];
        return $toReturn;
    }
}
