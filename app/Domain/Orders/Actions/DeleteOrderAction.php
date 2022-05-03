<?php

namespace App\Domain\Orders\Actions;

use App\Domain\Orders\Models\Order;

class DeleteOrderAction
{
    public function execute(int $orderId): Order|null
    {
        $order = Order::all()->find($orderId);

        if(!is_null($order))
            $order->delete();

        return null;
    }
}
