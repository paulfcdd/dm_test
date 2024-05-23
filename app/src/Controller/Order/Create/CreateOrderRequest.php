<?php

declare(strict_types=1);

namespace App\Controller\Order\Create;

use App\Command\Order\Create\CreateOrderCommand;
use App\Dto\OrderDto;
use App\Dto\OrderItemDto;
use Symfony\Component\Validator\Constraints as Assert;

class CreateOrderRequest
{
    public function __construct(
        #[Assert\NotBlank]
        public array $items
    ) {
    }

    public function getCommand(): CreateOrderCommand
    {
        $itemsDto = [];

        foreach ($this->items as $item) {
            $itemDto = new OrderItemDto(
                $item['product_id'],
                $item['quantity'],
            );
            $itemsDto[] = $itemDto;
        }

        return new CreateOrderCommand(
            new OrderDto($itemsDto)
        );
    }
}
