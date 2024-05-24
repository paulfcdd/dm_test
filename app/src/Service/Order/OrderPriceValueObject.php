<?php

declare(strict_types=1);

namespace App\Service\Order;

readonly class OrderPriceValueObject
{
    public function __construct(
        public float $subtotal,
        public float $total
    ) {
    }
}
