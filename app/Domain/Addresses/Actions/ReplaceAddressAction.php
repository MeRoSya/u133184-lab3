<?php

namespace App\Domain\Addresses\Actions;

use App\Domain\Addresses\Models\Address;
use Illuminate\Support\ItemNotFoundException;

class ReplaceAddressAction
{
    public function execute(int $addressId, array $fields): Address
    {
        $address = Address::all()->find($addressId);

        if (!is_null($address))
            $address->update($fields);
        else
            throw new ItemNotFoundException("Address not found");

        return $address;
    }
}
