<?php

namespace App\Http\ApiV1\Addresses\Resources;

use App\Http\ApiV1\Common\Resources\CommonJsonResource;
use App\Http\ApiV1\Customers\Resources\CustomerSubResource;
use App\Domain\Addresses\Models\Address;

/** @mixin Address */
class AddressJsonResource extends CommonJsonResource
{
    public function toArray($request)
    {
        if (empty($this['errors'])) {
            $toReturn = parent::toArray($request);
            $data = $this['data'];

            $toReturn['data'] = [
                'id' => $data->id,
                'customer' => new CustomerSubResource($data->customer),
                'city' => $data->city,
                'street' => $data->street,
                'building' => $data->building,
                'floor' => $data->floor,
                'flat' => $data->flat
            ];
        } else {
            $toReturn['data'] = null;
            $toReturn['errors'] = $this['errors'];
        }

        return $toReturn;
    }
}
