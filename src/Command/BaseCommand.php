<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Command;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Stopwatch\Stopwatch;
use whatwedo\CoreBundle\Command\Traits\ConsoleOutput;

abstract class BaseCommand extends Command
{
    use ConsoleOutput;

    protected ?InputInterface $input = null;

    protected ?Stopwatch $stopwatch = null;

    public function __construct(
        protected ?ManagerRegistry $registry = null
    ) {
        parent::__construct();
    }

    public function getInput(): ?InputInterface
    {
        return $this->input;
    }

    public function getDoctrine(): ?ManagerRegistry
    {
        return $this->registry;
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
