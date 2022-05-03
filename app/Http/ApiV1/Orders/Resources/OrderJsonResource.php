<?php

namespace App\Http\ApiV1\Orders\Resources;

use App\Http\ApiV1\Addresses\Resources\AddressSubResource;
use App\Http\ApiV1\Common\Resources\CommonJsonResource;
use App\Http\ApiV1\Customers\Resources\CustomerSubResource;

class OrderJsonResource extends CommonJsonResource
{
    public function toArray($request)
    {
        if(empty($this['errors'])) {
            $toReturn = parent::toArray($request);
            $data = $this['data'];

            if(is_null($data))
                $toReturn['data'] = null;
            else
                $toReturn['data'] = [
                    'id' => $data->id,
                    'address' => new AddressSubResource($data->address),
                    'customer' => new CustomerSubResource($data->customer),
                    'creation_time' => $data->creation_time,
                    'deliver_before' => $data->deliver_before,
                    'cost' => $data->cost,
                    'payed' => $data->payed,
                    'delivered' => $data->delivered
                ];
        }
        else
        {
            $toReturn['data'] = null;
            $toReturn['errors'] = $this['errors'];
        }

        return $toReturn;
    }
}
