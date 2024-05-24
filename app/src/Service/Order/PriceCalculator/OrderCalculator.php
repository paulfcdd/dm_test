<?php

declare(strict_types=1);

namespace App\Service\Order\PriceCalculator;

use App\Entity\Order;

readonly class OrderCalculator
{
    public function __construct(
        private iterable $collectors
    ) {
    }

    public function getOrderPrice(Order $order): OrderPriceValueObject
    {
        $subtotal = 0.0;
        $vat = 0.0;
        $total = 0.0;

        foreach ($this->collectors as $collector) {
            $collector->collect($order);
            $subtotal += $collector->getSubtotal();
            $vat += $collector->getVat();
            $total += $collector->getTotal();
        }

        return new OrderPriceValueObject(
            round($subtotal, 2),
            round($vat, 2),
            round($total, 2)
        );
    }
}
