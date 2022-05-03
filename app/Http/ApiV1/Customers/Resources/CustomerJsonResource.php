<?php

namespace App\Http\ApiV1\Customers\Resources;

use App\Http\ApiV1\Addresses\Resources\AddressSubResource;
use App\Http\ApiV1\Orders\Resources\OrderSubResource;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Customer */
class CustomerJsonResource extends JsonResource
{
    public function toArray($request)
    {
        $toReturn = [
            'id' => $this->id,
            'name' => $this->name
        ];

        if (str_contains($request->include, 'addresses')) {
            $addresses = [];

            foreach ($this->addresses as $address)
                $addresses[] = new AddressSubResource($address);

            $toReturn['addresses'] = $addresses;
        }

        if (str_contains($request->include, 'orders')) {
            $orders = [];

            foreach ($this->orders as $order)
                $orders[] = new OrderSubResource($order);

            $toReturn['orders'] = $orders;
        }

        return $toReturn;
    }
}
