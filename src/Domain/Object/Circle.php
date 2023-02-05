<?php
declare(strict_types=1);

namespace App\Domain\Object;

final readonly class Circle implements ObjectInterface
{
    public function __construct(public int $radius)
    {
    }

    public function getSurface(): float
    {
        return M_PI * \pow($this->radius, 2);
    }
}
