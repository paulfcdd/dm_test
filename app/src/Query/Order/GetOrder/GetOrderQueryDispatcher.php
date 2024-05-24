<?php

declare(strict_types=1);

namespace App\Query\Order\GetOrder;

use App\Dto\GetOrderDto;
use App\Dto\GetOrderItemDto;
use App\Query\QueryDispatcherInterface;
use App\Query\QueryInterface;
use App\Repository\OrderRepository;

class GetOrderQueryDispatcher implements QueryDispatcherInterface
{
    public function __construct(
        private readonly OrderRepository $orderRepository,
    ) {
    }

    public function dispatch(QueryInterface $query): mixed
    {
        $order = $this->orderRepository->find($query->id);
        if (null === $order) {
            throw new \Exception('Order not found', 404);
        }

        $orderItemsDto = [];
        foreach ($order->getItems() as $orderItem) {
            $product = $orderItem->getProduct();
            $quantity = $orderItem->getQuantity();
            $unitPrice = $product->getPrice();
            $totalPrice = round($quantity * $unitPrice, 2);

            $orderItemsDto[] = new GetOrderItemDto(
                $product->getName(),
                $quantity,
                $unitPrice,
                $totalPrice
            );
        }

        return new GetOrderDto(
            $order->getId(),
            $order->getCreatedAt(),
            $orderItemsDto,
            $order->getGrossPrice(),
            $order->getNetPrice(),
            $order->getVat()
        );
    }
}
