<?php
declare(strict_types=1);

namespace App\Domain\Object;

interface ObjectInterface
{
    public function getSurface(): int | float;
}
