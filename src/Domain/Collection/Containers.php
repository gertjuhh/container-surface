<?php
declare(strict_types=1);

namespace App\Domain\Collection;

use App\Domain\Container;

/**
 * @extends \ArrayObject<array-key, Container>
 */
final class Containers extends \ArrayObject
{
    public function sortBySizeSmallestFirst(): void
    {
        $this->uasort(
            static fn (Container $container1, Container $container2): int => $container1->getSurfaceArea() <=> $container2->getSurfaceArea()
        );
    }
}
