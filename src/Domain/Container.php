<?php
declare(strict_types=1);

namespace App\Domain;

final class Container
{
    public function __construct(public int $width, public int $length)
    {
    }

    public function getSurfaceArea(): int
    {
        return $this->width * $this->length;
    }
}
