<?php

declare(strict_types=1);

namespace App\Command\Order\Create;

use App\Command\CommandHandlerInterface;
use App\Command\CommandInterface;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Service\Order\PriceCalculator\OrderCalculator;

class CreateOrderHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly OrderRepository $orderRepository,
        private readonly OrderCalculator $calculator
    ) {
    }

    public function handle(CommandInterface $command): void
    {
        $orderDto = $command->orderDto;
        $order = new Order();
        $order->setId($command->orderId->value());
        foreach ($orderDto->items as $item) {
            $product = $this->productRepository->find($item->productId);
            if ($product === null) {
                throw new \Exception('Product not found', 404);
            }

            $orderItem = new OrderItem();
            $orderItem->setProduct($product);
            $orderItem->setQuantity($item->quantity);
            $orderItem->setOrder($order);
            $order->addOrderItem($orderItem);
        }

        $orderPrice = $this->calculator->getOrderPrice($order);

        $order->setGrossPrice($orderPrice->gross);
        $order->setNetPrice($orderPrice->net);
        $order->setVat($orderPrice->vat);

        $this->orderRepository->save($order);
    }
}
