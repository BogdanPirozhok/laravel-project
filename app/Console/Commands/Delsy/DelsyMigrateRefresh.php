<?php

namespace App\Console\Commands\Delsy;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class DelsyMigrateRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delsy:migrate:refresh
                            {--seed=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migration command';

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
        $seedOption = $this->option('seed');
        $this->info($seedOption);
        if(!in_array($seedOption, ['dev', 'prod'])) {
            $this->error('You need to provide type of seeder: dev or prod');
            $seedOption = $this->choice('What seeder do you want to pick', ['dev', 'prod']);
        }

        $this->call('migrate:refresh');

        switch ($seedOption) {
            case 'dev':
                $this->call('db:seed', [
                    '--class' => 'DevelopmentSeeder'
                ]);
                break;
            case 'prod':
                $this->call('db:seed', [
                    '--class' => 'ProductionSeeder'
                ]);
                break;
            default:
                break;
        }


        return 0;
    }
}
