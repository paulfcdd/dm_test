<?php

declare(strict_types=1);

namespace App\Service\Order;

use App\Entity\Order;

class VatCollector implements PriceCollectorInterface
{
    private float $vat = 0.0;
    private const VAT_RATE = 0.23;

    public function collect(Order $order): void
    {
        $this->vat = 0.0;

        foreach ($order->getItems() as $item) {
            $priceWithVat = $item->getProduct()->getPrice();
            $priceWithoutVat = $priceWithVat / (1 + self::VAT_RATE);
            $this->vat += ($priceWithVat - $priceWithoutVat) * $item->getQuantity();
        }
    }

    public function getSubtotal(): float
    {
        return 0.0;
    }

    public function getVat(): float
    {
        return $this->vat;
    }

    public function getTotal(): float
    {
        return 0.0;
    }
}
