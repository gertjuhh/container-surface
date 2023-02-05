<?php
declare(strict_types=1);

namespace App\Domain\Collection;

use App\Domain\Object\ObjectInterface;

/** @extends \ArrayObject<array-key, ObjectInterface> */
final class Objects extends \ArrayObject
{
    public function totalSurface(): int | float
    {
        return \array_reduce(
            (array) $this,
            static fn (int | float $surface, ObjectInterface $object): int | float => $surface + $object->getSurface(),
            0
        );
    }
}
