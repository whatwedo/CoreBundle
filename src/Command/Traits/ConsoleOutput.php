<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Command\Traits;

use Symfony\Component\Console\Output\OutputInterface;

trait ConsoleOutput
{
    protected bool $verbose = false;

    protected OutputInterface $output;

    /**
     * @return $this
     */
    public function setOutput(\Symfony\Component\Console\Output\OutputInterface $output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     * @return OutputInterface
     */
    public function getOutput()
    {
        return $this->output;
    }

    public function log(string $message)
    {
        if ($this->isVerbose()) {
            $message = date('[H:i:s] ') . $message;
        }
        $this->getOutput()->writeln($message);
    }

    /**
     * @param $message
     */
    public function debug($message)
    {
        if ($this->isVerbose()) {
            $this->log($message);
        }
    }

    /**
     * @return bool
     */
    public function isVerbose()
    {
        return $this->verbose;
    }

    /**
     * @return $this
     */
    public function setVerbose(bool $verbose)
    {
        $this->verbose = $verbose;

        return $this;
    }
}
