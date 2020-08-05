<?php

namespace Dejury\Envcrypt\Console\Traits;

trait ShouldHaveEnvironment
{
    protected $_choosenEnv = null;

    /**
     * @return string
     */
    public function chooseEnvironment(): string
    {
        $environment = $this->askWithCompletion('For which environment do you want to add this key? Use all for all',
            array_merge(['all' => 'All'], config('envcrypt.environments')));

        $this->_choosenEnv = $environment;

        return $environment;
    }

    /**
     * @return array
     */
    public function environments(): array
    {
        if ($this->_choosenEnv == 'all') {
            return config('envcrypt.environments');
        }
        return [$this->_choosenEnv];
    }


}