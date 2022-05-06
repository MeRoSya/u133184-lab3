<?php

namespace App\Domain\Orders\Actions;

use App\Domain\Orders\Models\Order;

class CreateOrderAction
{
    public function execute(array $fields): Order
    {
        $order = new Order($fields);
        $order->save();
        return $order;
    }
}
