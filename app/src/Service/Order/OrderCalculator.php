<?php

declare(strict_types=1);

namespace App\Service\Order;

use App\Entity\Order;

class OrderCalculator
{
    public function getOrderPrice(Order $order): OrderPriceValueObject
    {
        $subtotal = 0.0;

        foreach ($order->getItems() as $item) {
            $itemTotal = $item->getProduct()->getPrice() * $item->getQuantity();
            $subtotal += $itemTotal;
        }

        $total = round($subtotal, 2);

        return new OrderPriceValueObject(
            $subtotal,
            $total
        );
    }
}
