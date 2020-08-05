<?php

namespace Dejury\Envcrypt\Console;

use Dejury\Envcrypt\Console\Traits\ShouldHaveEnvironment;
use Dejury\Envcrypt\Envcrypt;
use Illuminate\Console\Command;

class Remove extends Command
{
    use ShouldHaveEnvironment;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'envcrypt:remove {key : Which key do you want to remove}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove an encrypted value';

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

            if ($this->confirm("Are you sure you want to remove this key?", true)) {

                foreach ($this->environments() as $env) {
                    $envcrypt->setEnv($env)->remove($this->key())->store();
                }

                $this->info("Successfully removed the key: ".$this->key());
            } else {
                $this->info("Not removed");
            }

        } else {
            $this->error("You should choose a valid environment!");
        }
    }

}