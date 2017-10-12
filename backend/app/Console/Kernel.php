<?php

namespace App\Console;

use App\Console\Commands\Elastic\IndexClientsCommand;
use App\Console\Commands\Elastic\IndexRepairsCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\MakeSitemap::class,
        Commands\MakeYml::class,
        IndexClientsCommand::class,
        IndexRepairsCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('elastic:repairs')
             ->daily()
             ->sendOutputTo(storage_path('logs/elastic.log'));
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
