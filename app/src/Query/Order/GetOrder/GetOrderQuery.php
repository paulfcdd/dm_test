<?php

declare(strict_types=1);

namespace App\Query\Order\GetOrder;

use App\Entity\OrderId;
use App\Query\QueryInterface;

class GetOrderQuery implements QueryInterface
{
    public function __construct(
        public OrderId $id
    ) {
    }
}
