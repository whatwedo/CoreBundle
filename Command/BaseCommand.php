<?php
/*
 * Copyright (c) 2016, whatwedo GmbH
 * All rights reserved
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 * IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT,
 * INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT
 * NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */


namespace whatwedo\CoreBundle\Command;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Stopwatch\Stopwatch;
use whatwedo\CoreBundle\Command\Traits\ConsoleOutput;

/**
 * Class BaseCommand
 * @package whatwedo\School\CoreBundle\Command
 */
abstract class BaseCommand extends ContainerAwareCommand
{
    use ConsoleOutput;

    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @var Registry
     */
    protected $registry = null;

    /**
     * @var Stopwatch
     */
    protected $stopwatch;

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Initialize input/output
        $this->input = $input;
        $this->output = $output;

        // Initialize stopwatch
        $this->startStopwatch();
        $this->debug('Starting execution');

        // Initialize settings
        if ($this->input->getOption('verbose')) {
            $this->verbose = true;
        }

        // Dump settings
        $this->debug('Arguments: ' . var_export($input->getArguments(), true));
        $this->debug('Options: ' . var_export($input->getOptions(), true));
    }

    /**
     * @return InputInterface
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Get service by name
     *
     * @param $name
     * @return object
     */
    protected function get($name)
    {
        return $this->getContainer()->get($name);
    }

    /**
     * @return Registry
     */
    public function getDoctrine()
    {
        if ($this->registry === null) {
            $this->registry = $this->get('doctrine');
        }

        return $this->registry;
    }

    /**
     * Initialize and start stopwatch
     */
    private function startStopwatch()
    {
        $this->stopwatch = new Stopwatch();
        $this->stopwatch->start('command');
    }

    /**
     * Initialize and start stopwatch
     */
    private function stopStopwatch()
    {
        $event = $this->stopwatch->stop('command');
        $this->debug('Finished in ' . $event->getDuration() . 'ms');
    }

    /**
     *
     */
    protected function tearDown()
    {
        $this->stopStopwatch();
    }
}
