<?php

declare(strict_types=1);

namespace App\Dto;

class OrderDto
{
    /**
     * @param OrderItemDto[] $items
     */
    public function __construct(
        public array $items
    ) {
    }
}
