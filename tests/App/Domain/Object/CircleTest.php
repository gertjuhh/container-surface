<?php
declare(strict_types=1);

namespace App\Domain\Object;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class CircleTest extends TestCase
{
    public static function circleGenerator(): \Generator
    {
        yield [3.141592653589793, new Circle(1)];
        yield [12.566370614359172, new Circle(2)];
        yield [28.274333882308138, new Circle(3)];
    }

    #[DataProvider('circleGenerator')]
    public function testGetSurface(float $expected, Circle $circle): void
    {
        self::assertSame($expected, $circle->getSurface());
    }
}
