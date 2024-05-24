<?php

declare(strict_types=1);

namespace App\Service\Order\PriceCalculator;

readonly class OrderPriceValueObject
{
    public function __construct(
        public float $net,
        public float $vat,
        public float $gross
    ) {
    }
}
