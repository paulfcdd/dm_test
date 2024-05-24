<?php

declare(strict_types=1);

namespace App\Service\Order\PriceCalculator;

use App\Entity\Order;

class GrossPriceCollector implements PriceCollectorInterface
{
    private float $total = 0.0;

    public function collect(Order $order): void
    {
        $subtotalCollector = new NetPriceCollector();
        $subtotalCollector->collect($order);

        $vatCollector = new VatCollector();
        $vatCollector->collect($order);

        $this->total = $subtotalCollector->getSubtotal() + $vatCollector->getVat();
    }

    public function getSubtotal(): float
    {
        return 0.0;
    }

    public function getVat(): float
    {
        return 0.0;
    }

    public function getTotal(): float
    {
        return $this->total;
    }
}
