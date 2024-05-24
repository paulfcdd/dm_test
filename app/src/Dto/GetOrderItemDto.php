<?php

declare(strict_types=1);

namespace App\Dto;

class GetOrderItemDto
{
    public function __construct(
        public string $productName,
        public int $quantity,
        public float $unitPrice,
        public float $totalPrice,
    ) {
    }
}
