<?php
declare(strict_types=1);

namespace App\Domain\Collection;

use App\Domain\Container;
use PHPUnit\Framework\TestCase;

final class ContainersTest extends TestCase
{
    public function testSortBySizeSmallestFirst(): void
    {
        $collection = new Containers(
            [
                $container1 = new Container(2, 2),
                $container2 = new Container(1, 2),
                $container3 = new Container(1, 1),
            ]
        );
        $collection->sortBySizeSmallestFirst();;

        $iterator = $collection->getIterator();
        self::assertSame($container3, $iterator->current());
        $iterator->next();
        self::assertSame($container2, $iterator->current());
        $iterator->next();
        self::assertSame($container1, $iterator->current());
    }
}
