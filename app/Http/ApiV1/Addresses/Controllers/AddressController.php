<?php

namespace App\Http\ApiV1\Addresses\Controllers;

use App\Domain\Addresses\Actions\CreateAddressAction;
use App\Domain\Addresses\Actions\ReplaceAddressAction;
use App\Http\ApiV1\Addresses\Requests\CreateAddressRequest;
use App\Http\ApiV1\Addresses\Requests\ReplaceAddressRequest;
use App\Http\ApiV1\Addresses\Resources\AddressJsonResource;
use App\Http\ApiV1\Common\Resources\ErrorJsonResource;
use Illuminate\Support\ItemNotFoundException;

class AddressController
{
    public function create(
        CreateAddressRequest $request,
        CreateAddressAction $action
    ): \Illuminate\Http\JsonResponse {
        $toReturn = null;

        $result = [];
        $result['errors'] = [];
        try {
            $result['data'] = $action->execute($request->validated());

            $toReturn = (new AddressJsonResource($result))->response()->setStatusCode(200);
        } catch (\Exception $ex) {
            $result['errors'][] = [new ErrorJsonResource($ex)];
            $toReturn = (new AddressJsonResource($result))->response()->setStatusCode(500);
        }

        return $toReturn;
    }

    public function replace(
        int $addressId,
        ReplaceAddressRequest $request,
        ReplaceAddressAction $action
    ): \Illuminate\Http\JsonResponse {
        $toReturn = null;

        $result = [];
        $result['errors'] = [];
        try {
            $result['data'] = $action->execute($addressId, $request->validated());

            $toReturn = (new AddressJsonResource($result))->response()->setStatusCode(200);
        } catch (ItemNotFoundException $ex) {
            $result['errors'][] = [new ErrorJsonResource($ex)];
            $toReturn = (new AddressJsonResource($result))->response()->setStatusCode(404);
        } catch (\Exception $ex) {
            $result['errors'][] = [new ErrorJsonResource($ex)];
            $toReturn = (new AddressJsonResource($result))->response()->setStatusCode(500);
        }

        return $toReturn;
    }
}
