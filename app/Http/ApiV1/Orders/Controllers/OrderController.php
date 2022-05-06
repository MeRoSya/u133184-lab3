<?php

namespace App\Http\ApiV1\Orders\Controllers;

use App\Domain\Orders\Actions\ChangeOrderAction;
use App\Domain\Orders\Actions\CreateOrderAction;
use App\Domain\Orders\Actions\DeleteOrderAction;
use App\Http\ApiV1\Common\Resources\ErrorJsonResource;
use App\Http\ApiV1\Orders\Requests\ChangeOrderRequest;
use App\Http\ApiV1\Orders\Requests\CreateOrderRequest;
use App\Http\ApiV1\Orders\Requests\DeleteOrderRequest;
use App\Http\ApiV1\Orders\Resources\OrderJsonResource;
use Illuminate\Support\ItemNotFoundException;

class OrderController
{
    public function create(
        CreateOrderRequest $request,
        CreateOrderAction $action
    ): \Illuminate\Http\JsonResponse {
        $toReturn = null;

        $result = [];
        $result['errors'] = [];
        try {
            $result['data'] = $action->execute($request->validated());

            $toReturn = (new OrderJsonResource($result))->response()->setStatusCode(201);
        } catch (\Exception $ex) {
            $result['errors'] = [new ErrorJsonResource($ex)];
            $toReturn = (new OrderJsonResource($result))->response()->setStatusCode(500);
        }

        return $toReturn;
    }

    public function change(
        int $orderId,
        ChangeOrderRequest $request,
        ChangeOrderAction $action
    ): \Illuminate\Http\JsonResponse {
        $toReturn = null;

        $result = [];
        $result['errors'] = [];
        try {
            $result['data'] = $action->execute($orderId, $request->validated());

            $toReturn = (new OrderJsonResource($result))->response()->setStatusCode(200);
        } catch (ItemNotFoundException $ex) {
            $result['errors'] = [new ErrorJsonResource($ex)];
            $toReturn = (new OrderJsonResource($result))->response()->setStatusCode(404);
        } catch (\Exception $ex) {
            $result['errors'] = [new ErrorJsonResource($ex)];
            $toReturn = (new OrderJsonResource($result))->response()->setStatusCode(500);
        }

        return $toReturn;
    }

    public function delete(
        int $orderId,
        DeleteOrderRequest $request,
        DeleteOrderAction $action
    ): \Illuminate\Http\JsonResponse {
        $toReturn = null;

        $result = [];
        $result['errors'] = [];
        try {
            $result['data'] = $action->execute($orderId);

            $toReturn = (new OrderJsonResource($result))->response()->setStatusCode(200);
        } catch (\Exception $ex) {
            $result['errors'] = [new ErrorJsonResource($ex)];
            $toReturn = (new OrderJsonResource($result))->response()->setStatusCode(500);
        }

        return $toReturn;
    }
}
