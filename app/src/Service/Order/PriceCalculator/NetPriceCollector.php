<?php

declare(strict_types=1);

namespace App\Service\Order\PriceCalculator;

use App\Entity\Order;

class NetPriceCollector implements PriceCollectorInterface
{
    private float $subtotal = 0.0;
    private const VAT_RATE = 0.23;

    public function collect(Order $order): void
    {
        $this->subtotal = 0.0;

        foreach ($order->getItems() as $item) {
            $priceWithVat = $item->getProduct()->getPrice();
            $priceWithoutVat = $priceWithVat / (1 + self::VAT_RATE);
            $this->subtotal += $priceWithoutVat * $item->getQuantity();
        }
    }

    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    public function getVat(): float
    {
        return 0.0;
    }

    public function getTotal(): float
    {
        return 0.0;
    }
}
