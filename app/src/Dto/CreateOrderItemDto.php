<?php

declare(strict_types=1);

namespace App\Dto;
use Symfony\Component\Validator\Constraints as Assert;

class CreateOrderItemDto
{
    public function __construct(
        #[Assert\NotBlank()]
        public int $productId,
        #[Assert\NotBlank()]
        public int $quantity,
    ) {
    }
}
