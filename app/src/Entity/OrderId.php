<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class OrderId extends Uuid
{
    public function value(): string
    {
        return $this->toRfc4122();
    }

    public static function generate(): self
    {
        return new self(Uuid::v4()->toRfc4122());
    }
}
