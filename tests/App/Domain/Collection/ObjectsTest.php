<?php
declare(strict_types=1);

namespace App\Domain\Collection;

use App\Domain\Object\Circle;
use App\Domain\Object\Rectangle;
use PHPUnit\Framework\TestCase;

final class ObjectsTest extends TestCase
{
    public function testTotalSurfaceArea(): void
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
            $object1->getSurfaceArea() + $object2->getSurfaceArea() + $object3->getSurfaceArea() + $object4->getSurfaceArea(),
            $collection->totalSurfaceArea()
        );
    }
}
