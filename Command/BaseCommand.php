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
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Stopwatch\Stopwatch;
use whatwedo\CoreBundle\Command\Traits\ConsoleOutput;

/**
 * Class BaseCommand.
 */
abstract class BaseCommand extends Command implements ContainerAwareInterface
{
    use ConsoleOutput;
    use ContainerAwareTrait;

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
     * @return InputInterface
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @return Registry
     */
    public function getDoctrine()
    {
        if (null === $this->registry) {
            $this->registry = $this->get('doctrine');
        }

        return $this->registry;
    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * @return int|void|null
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
        $this->debug('Arguments: '.var_export($input->getArguments(), true));
        $this->debug('Options: '.var_export($input->getOptions(), true));
    }

    /**
     * Get service by name.
     *
     * @param $name
     *
     * @return object
     */
    protected function get($name)
    {
        return $this->getContainer()->get($name);
    }

    /**
     * Initialize and start stopwatch.
     */
    private function startStopwatch()
    {
        $this->stopwatch = new Stopwatch();
        $this->stopwatch->start('command');
    }

    /**
     * Initialize and start stopwatch.
     */
    private function stopStopwatch()
    {
        $event = $this->stopwatch->stop('command');
        $this->debug('Finished in '.$event->getDuration().'ms');
    }

    protected function tearDown()
    {
        $this->stopStopwatch();
    }
}
