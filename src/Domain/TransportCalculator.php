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
        $requiredSurface = $objects->totalSurface();

        if (count($availableContainers) == 0) {
            throw new \RuntimeException('No containers available');
        }

        $availableContainers->sortBySizeSmallestFirst();

        while ($requiredSurface > 0) {
            foreach ($availableContainers as $container) {
                $containerSurface = $container->getSurface();
                if ($containerSurface >= $requiredSurface) {
                    break;
                }
            }
            \assert(isset($containerSurface) && \is_numeric($containerSurface));
            $requiredSurface -= $containerSurface;
            \assert(isset($container) && $container instanceof Container);
            $requiredContainers->append($container);
        }

        return $requiredContainers;
    }
}
