<?php
declare(strict_types=1);

namespace App\Domain\Object;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class RectangleTest extends TestCase
{
    public static function rectangleGenerator(): \Generator
    {
        yield [1, new Rectangle(1, 1)];
        yield [2, new Rectangle(1, 2)];
        yield [4, new Rectangle(2, 2)];
    }

    #[DataProvider('rectangleGenerator')]
    public function testGetSurfaceArea(int $expected, Rectangle $rectangle): void
    {
        self::assertSame($expected, $rectangle->getSurfaceArea());
    }
}
