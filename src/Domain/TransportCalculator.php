<?php
declare(strict_types=1);

namespace App\Domain;

use App\Domain\Collection\Containers;
use App\Domain\Collection\Objects;

final class TransportCalculator
{
    /** @throws \RuntimeException */
    public function getContainers(Containers $availableContainers, Objects $objects): Containers
    {
        $requiredContainers = new Containers([]);
        $requiredSurfaceArea = $objects->totalSurfaceArea();

        if (0 === \count($availableContainers)) {
            throw new \RuntimeException('No containers available');
        }

        $availableContainers->sortBySizeSmallestFirst();

        while ($requiredSurfaceArea > 0) {
            $container = $this->determineSmallestAvailableContainer($requiredSurfaceArea, $availableContainers);
            $requiredSurfaceArea -= $container->getSurfaceArea();
            $requiredContainers->append($container);
        }

        return $requiredContainers;
    }

    private function determineSmallestAvailableContainer(
        int | float $requiredSurfaceArea,
        Containers $availableContainers
    ): Container {
        foreach ($availableContainers as $container) {
            $containerSurfaceArea = $container->getSurfaceArea();
            if ($containerSurfaceArea >= $requiredSurfaceArea) {
                return $container;
            }
        }

        // fallback to biggest container available
        \assert(isset($container) && $container instanceof Container);

        return $container;
    }
}
