<?php

namespace App\Http\ApiV1\Customers\Controllers;

use App\Domain\Customers\Actions\GetCustomersAction;
use App\Http\ApiV1\Common\Resources\ErrorJsonResource;
use App\Http\ApiV1\Customers\Requests\GetCustomersRequest;
use App\Http\ApiV1\Customers\Resources\CustomersJsonResource;

class CustomerController
{
    public function list(GetCustomersRequest $request,
                            GetCustomersAction $action): \Illuminate\Http\JsonResponse
    {
        $toReturn = null;

        $result = [];
        $result['errors'] = [];
        try {
            $result['data'] = $action->execute($request->validated());
            $toReturn = (new CustomersJsonResource($result))->response()->setStatusCode(200);
        } catch (\Exception $ex)
        {
            $result['errors'][] = [new ErrorJsonResource($ex)];
            $toReturn = (new CustomersJsonResource($result))->response()->setStatusCode(500);
        }

        return $toReturn;
    }
}
