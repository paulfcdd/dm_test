<?php

declare(strict_types=1);

namespace App\Controller\Order\Create;

use App\Command\Order\Create\CreateOrderCommand;
use App\Dto\CreateOrderDto;
use App\Dto\CreateOrderItemDto;
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
            $itemDto = new CreateOrderItemDto(
                $item['product_id'],
                $item['quantity'],
            );
            $itemsDto[] = $itemDto;
        }

        return new CreateOrderCommand(
            new CreateOrderDto($itemsDto)
        );
    }
}
