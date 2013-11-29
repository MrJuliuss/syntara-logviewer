<?php

namespace MrJuliuss\SyntaraLogviewer\Commands;

use Illuminate\Console\Command;

class UpdateCommand extends Command 
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'logviewer:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syntara logviewer update command';

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
        $this->info('## Syntara Logviewer Update ##');

        // publish syntara logviewer assets
        $this->call('asset:publish', array('package' => 'mrjuliuss/syntara-logviewer' ) );
    }
}
