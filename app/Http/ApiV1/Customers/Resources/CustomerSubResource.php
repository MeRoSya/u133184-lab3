<?php

namespace App\Http\ApiV1\Customers\Resources;

use App\Domain\Customers\Models\Customer;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Used when customer should be inserted in another object 
 * @mixin Customer
 */
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
