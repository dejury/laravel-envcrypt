<?php

namespace Dejury\Envcrypt\Console;

use Dejury\Envcrypt\Envcrypt;
use Illuminate\Console\Command;

class View extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'envcrypt:view {environment : Which environment file you wish to view}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'View all encrypted values';

    /**
     * @return string
     */
    protected function env()
    {
        return $this->argument('environment');
    }

    /**
     * @param  Envcrypt  $envcrypt
     */
    public function handle(Envcrypt $envcrypt)
    {
        $decrypted = $envcrypt->setEnv($this->env())->load()->content();

        $this->info($decrypted);
    }

}