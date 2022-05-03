<?php

namespace App\Http\ApiV1\Addresses\Controllers;

use App\Domain\Addresses\Actions\CreateAddressAction;
use App\Domain\Addresses\Actions\ReplaceAddressAction;
use App\Http\ApiV1\Addresses\Requests\CreateAddressRequest;
use App\Http\ApiV1\Addresses\Requests\ReplaceAddressRequest;
use App\Http\ApiV1\Addresses\Resources\AddressJsonResource;

class AddressController
{
    public function create(CreateAddressRequest $request,
                            CreateAddressAction $action)
    {
        return new AddressJsonResource($action->execute($request->validated()));
    }

    public function replace(int $addressId,
                           ReplaceAddressRequest $request,
                           ReplaceAddressAction $action)
    {
        return new AddressJsonResource($action->execute($addressId, $request->validated()));
    }
}
