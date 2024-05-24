<?php

declare(strict_types=1);

namespace App\Dto;

class GetOrderDto
{
    /**
     * @param GetOrderItemDto[] $items
     */
    public function __construct(
        public string $id,
        public \DateTimeImmutable $createdAt,
        public array $items,
        public float $grossPrice,
        public float $netPrice,
        public float $vat
    ) {
    }
}
