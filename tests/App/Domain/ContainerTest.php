<?php
declare(strict_types=1);

namespace App\Domain;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ContainerTest extends TestCase
{
    public static function containerGenerator(): \Generator
    {
        yield [1, new Container(1, 1)];
        yield [2, new Container(1, 2)];
        yield [4, new Container(2, 2)];
    }

    #[DataProvider('containerGenerator')]
    public function testGetSurface(int $expected, Container $container): void
    {
        self::assertSame($expected, $container->getSurface());
    }
}
