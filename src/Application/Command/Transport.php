<?php
declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\Collection\Containers;
use App\Domain\Collection\Objects;
use App\Domain\Container;
use App\Domain\Object\Circle;
use App\Domain\Object\Rectangle;
use App\Domain\TransportCalculator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/** @psalm-api */
#[AsCommand(name: 'app:transport', description: 'Calculate a transport')]
final class Transport extends Command
{
    public function __construct(private readonly TransportCalculator $calculator)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $availableContainers = new Containers(
            [
                new Container(300, 200),
                new Container(100, 100),
            ]
        );

        $this->outputTransport(
            $output,
            $transport = new Objects(
                [
                    new Circle(50),
                    new Circle(50),
                    new Rectangle(100, 100),
                ]
            ),
            $this->calculator->getContainers($availableContainers, $transport)
        );

        $this->outputTransport(
            $output,
            $transport = new Objects(
                [
                    new Rectangle(400, 400),
                    new Circle(100),
                ]
            ),
            $this->calculator->getContainers($availableContainers, $transport)
        );

        $this->outputTransport(
            $output,
            $transport = new Objects(
                [
                    new Rectangle(150, 100),
                    new Rectangle(50, 50),
                    new Circle(50),
                ]
            ),
            $this->calculator->getContainers($availableContainers, $transport)
        );

        return Command::SUCCESS;
    }

    private function outputTransport(OutputInterface $output, Objects $transport, Containers $requiredContainers): void
    {
        $output->writeln(\sprintf('Total size of the transport: %s', $transport->totalSurfaceArea()));
        $output->writeln('Required containers:');

        foreach ($requiredContainers as $container) {
            $output->writeln(\sprintf('%s x %s', $container->length, $container->width));
        }
    }
}
