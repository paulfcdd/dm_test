<?php

declare(strict_types=1);

namespace App\Service\Order;

use App\Entity\Order;

class OrderCalculator
{
    public function calculateOrder(Order $order): CalculatedPriceDto
    {
        $subtotal = 0.0;
        $vat = 0.0;

        foreach ($order->getItems() as $item) {
            $itemTotal = $item->getProduct()->getPrice() * $item->getQuantity();
            $subtotal += $itemTotal;
            $vat += $itemTotal * 0.23;
        }

        $total = round($subtotal + $vat, 2);

        return new CalculatedPriceDto(
            $subtotal,
            $total,
            $vat
        );
    }
}
