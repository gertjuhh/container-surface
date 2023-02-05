<?php
declare(strict_types=1);

namespace App\Domain\Collection;

use App\Domain\Object\Circle;
use App\Domain\Object\Rectangle;
use PHPUnit\Framework\TestCase;

final class ObjectsTest extends TestCase
{
    public function testTotalSurface(): void
    {
        $collection = new Objects(
            [
                $object1 = new Circle(1),
                $object2 = new Circle(2),
                $object3 = new Rectangle(1, 2),
                $object4 = new Rectangle(3, 4),
            ]
        );

        self::assertSame(
            $object1->getSurface() + $object2->getSurface() + $object3->getSurface() + $object4->getSurface(),
            $collection->totalSurface()
        );
    }
}
