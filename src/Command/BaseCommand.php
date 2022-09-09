<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Stopwatch\Stopwatch;
use whatwedo\CoreBundle\Command\Traits\ConsoleOutput;

abstract class BaseCommand extends Command implements ContainerAwareInterface
{
    use ConsoleOutput;
    use ContainerAwareTrait;

    protected ?\Symfony\Component\Console\Input\InputInterface $input = null;

    protected ?object $registry = null;

    protected ?\Symfony\Component\Stopwatch\Stopwatch $stopwatch = null;

    public function getInput(): ?\Symfony\Component\Console\Input\InputInterface
    {
        return $this->input;
    }

    public function getDoctrine(): ?object
    {
        if ($this->registry === null) {
            $this->registry = $this->get('doctrine');
        }

        return $this->registry;
    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Initialize input/output
        $this->input = $input;
        $this->output = $output;

        // Initialize stopwatch
        $this->startStopwatch();
        $this->debug('Starting execution');
        $verboseInputOption = $this->input->getOption('verbose');

        // Initialize settings
        if ($verboseInputOption) {
            $this->verbose = true;
        }

        // Dump settings
        $this->debug('Arguments: ' . var_export($input->getArguments(), true));
        $this->debug('Options: ' . var_export($input->getOptions(), true));

        return Command::SUCCESS;
    }

    /**
     * Get service by name.
     */
    protected function get(string $name): ?object
    {
        return $this->getContainer()->get($name);
    }

    /**
     * Initialize and start stopwatch.
     */
    private function startStopwatch(): void
    {
        $this->stopwatch = new Stopwatch();
        $this->stopwatch->start('command');
    }

    /**
     * Initialize and start stopwatch.
     */
    private function stopStopwatch(): void
    {
        $event = $this->stopwatch->stop('command');
        $this->debug('Finished in ' . $event->getDuration() . 'ms');
    }

    protected function tearDown(): void
    {
        $this->stopStopwatch();
    }
}
