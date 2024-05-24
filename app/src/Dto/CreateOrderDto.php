<?php

declare(strict_types=1);

namespace App\Dto;

class CreateOrderDto
{
    /**
     * @param CreateOrderItemDto[] $items
     */
    public function __construct(
        public array $items
    ) {
    }
}
