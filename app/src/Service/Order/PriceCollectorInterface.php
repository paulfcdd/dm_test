<?php

declare(strict_types=1);

namespace App\Service\Order;

use App\Entity\Order;

interface PriceCollectorInterface
{
    public function collect(Order $order): void;
    public function getSubtotal(): float;
    public function getVat(): float;
    public function getTotal(): float;
}