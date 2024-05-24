<?php

declare(strict_types=1);

namespace App\Command\Order\Create;

use App\Command\CommandInterface;
use App\Dto\CreateOrderDto;

class CreateOrderCommand implements CommandInterface
{
    public function __construct(
        public readonly CreateOrderDto $orderDto
    ) {
    }
}
