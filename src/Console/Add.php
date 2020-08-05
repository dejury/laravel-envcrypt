<?php

namespace Dejury\Envcrypt\Console;

use Dejury\Envcrypt\Console\Traits\ShouldHaveEnvironment;
use Dejury\Envcrypt\Envcrypt;
use Illuminate\Console\Command;

class Add extends Command
{
    use ShouldHaveEnvironment;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'envcrypt:add {key : Which key do you want to add or edit?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add or edit an encrypted value';

    /**
     * @return string
     */
    protected function key()
    {
        return $this->argument('key');
    }

    /**
     * @param  Envcrypt  $envcrypt
     */
    public function handle(Envcrypt $envcrypt)
    {
        $env = $this->chooseEnvironment();
        if (!is_null($env)) {
            $value = $this->ask("What value should be added or edited? Leave empty for NULL");

            foreach ($this->environments() as $env) {
                $envcrypt->setEnv($env)->set($this->key(), $value)->store();
            }

            $this->info("Successfully changed the key: ".$this->key());

        } else {
            $this->error("You should choose a valid environment!");
        }
    }

}