<?php

namespace App\Http\ApiV1\Orders\Resources;

use App\Domain\Customers\Models\Order;
use App\Http\ApiV1\Addresses\Resources\AddressSubResource;
use Illuminate\Http\Resources\Json\JsonResource;

/** 
 * Used when order should be inserted in another object 
 * @mixin Order 
 * */
class OrderSubResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'address' => new AddressSubResource($this->address),
            'creation_time' => $this->creation_time,
            'deliver_before' => $this->deliver_before,
            'cost' => $this->cost,
            'payed' => $this->payed,
            'delivered' => $this->delivered
        ];
    }
}
