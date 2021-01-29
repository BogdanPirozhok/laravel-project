<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateLocalString extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'locale-string:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create locale string';

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
     * @return int
     */
    public function handle()
    {
        return 0;
    }


    protected function localeFiles()
    {

    }

    protected function locales()
    {

    }

}
