<?php

namespace App\Http\ApiV1\Customers\Resources;

use App\Domain\Customers\Models\Customer;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Customer */
class CustomerSubResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
