<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Command\Traits;

use Symfony\Component\Console\Output\OutputInterface;

trait ConsoleOutput
{
    protected bool $verbose = false;

    protected OutputInterface $output;

    public function setOutput(\Symfony\Component\Console\Output\OutputInterface $output): self
    {
        $this->output = $output;

        return $this;
    }

    public function getOutput(): OutputInterface
    {
        return $this->output;
    }

    public function log(string $message): void
    {
        if ($this->isVerbose()) {
            $message = date('[H:i:s] ') . $message;
        }
        $this->getOutput()->writeln($message);
    }

    public function debug(string $message): void
    {
        if ($this->isVerbose()) {
            $this->log($message);
        }
    }

    public function isVerbose(): bool
    {
        return $this->verbose;
    }

    public function setVerbose(bool $verbose): self
    {
        $this->verbose = $verbose;

        return $this;
    }
}
