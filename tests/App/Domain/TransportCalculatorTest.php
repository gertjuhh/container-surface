<?php
declare(strict_types=1);

namespace App\Domain;

use App\Domain\Collection\Containers;
use App\Domain\Collection\Objects;
use App\Domain\Object\Circle;
use App\Domain\Object\Rectangle;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class TransportCalculatorTest extends TestCase
{
    private Containers $availableContainers;
    private TransportCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new TransportCalculator();
        $this->availableContainers = new Containers(
            [
                new Container(1, 1),
                new Container(2, 2),
                new Container(2, 3),
            ]
        );
    }

    public static function smallestContainerGenerator(): \Generator
    {
        yield [new Objects([new Rectangle(1, 1)]), new Containers([new Container(1, 1)])];
        yield [new Objects([new Rectangle(1, 2)]), new Containers([new Container(2, 2)])];
        yield [new Objects([new Rectangle(2, 3)]), new Containers([new Container(2, 3)])];
        yield [new Objects([new Circle(1)]), new Containers([new Container(2, 2)])];
    }

    public function testGetContainersReturnsAnEmptyCollectionWhenThereAreNoObjects(): void
    {
        self::assertEquals(
            new Containers([]),
            $this->calculator->getContainers(new Containers([new Container(1, 1)]), new Objects([])),
        );
    }

    public function testGetContainersReturnsMultipleContainersForBiggerTransport(): void
    {
        self::assertEquals(
            new Containers([new Container(2, 3), new Container(1, 1)]),
            $this->calculator->getContainers(
                $this->availableContainers,
                new Objects(
                    [
                        new Circle(1),
                        new Rectangle(1, 2),
                        new Rectangle(1, 1),
                    ]
                )
            ),
        );
    }

    public function testGetContainersThrowsExceptionWhenThereAreNoContainersAvailable(): void
    {
        self::expectExceptionObject(new \RuntimeException('No containers available'));
        $this->calculator->getContainers(new Containers([]), new Objects([]));
    }

    #[DataProvider('smallestContainerGenerator')]
    public function testGetContainersUsesSmallestContainerPossible(Objects $objects, Containers $expected): void
    {
        self::assertEquals(
            $expected,
            $this->calculator->getContainers($this->availableContainers, $objects)
        );
    }
}
