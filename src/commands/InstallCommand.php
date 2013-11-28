<?php

namespace MrJuliuss\SyntaraLogviewer\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command 
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'logviewer:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syntara logviewer install command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->info('## Syntara Logviewer Install ##');

        // publish kmd logviewer config
        $this->call('config:publish', array('package' => 'kmd/logviewer' ) );

        // publish syntara logviewer assets
        $this->call('asset:publish', array('package' => 'mrjuliuss/syntara-logviewer' ) );
    }
}
