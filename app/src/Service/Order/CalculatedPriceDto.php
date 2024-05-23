<?php

declare(strict_types=1);

namespace App\Service\Order;

readonly class CalculatedPriceDto
{
    public function __construct(
        public float $subtotal,
        public float $total,
        public float $vat
    ) {
    }
}
