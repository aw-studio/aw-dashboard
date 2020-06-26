<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ForgeLoadCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('forge:servers');
        $this->call('forge:sites');
    }
}
