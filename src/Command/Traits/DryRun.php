<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Command\Traits;

trait DryRun
{
    /**
     * @var bool
     */
    protected $dryRun = false;

    /**
     * @return bool
     */
    public function isDryRun()
    {
        return $this->dryRun;
    }

    /**
     * @return DryRun
     */
    public function setDryRun(bool $dryRun = true)
    {
        $this->dryRun = $dryRun;

        return $this;
    }
}
