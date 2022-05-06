<?php

namespace App\Domain\Orders\Actions;

use App\Domain\Orders\Models\Order;
use Illuminate\Support\ItemNotFoundException;

class ChangeOrderAction
{
    public function execute(int $orderId, array $fields): Order
    {
        $order = Order::all()->find($orderId);

        if (!is_null($order))
            $order->update($fields);
        else
            throw new ItemNotFoundException("Address not found");

        return $order;
    }
}
