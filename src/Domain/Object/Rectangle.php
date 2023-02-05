<?php
declare(strict_types=1);

namespace App\Domain\Object;

final readonly class Rectangle implements ObjectInterface
{
    public function __construct(public int $width, public int $length)
    {
    }

    public function getSurface(): int
    {
        return $this->width * $this->length;
    }
}
