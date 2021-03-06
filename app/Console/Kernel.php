<?php

namespace App\Console;

use App\Jobs\GenerateCsvFiles;
use App\Jobs\GenerateStaticGtfs;
use App\Jobs\GenerateTripHeadsigns;
use App\Jobs\ProcessStopFile;
use App\Jobs\ProcessTripUpdate;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new ProcessTripUpdate())->everyFiveMinutes()->between('04:00', '01:00');
        $schedule->job(new ProcessStopFile(env('STOP_FILE_URL')))->dailyAt('01:10');
        $schedule->job(new GenerateTripHeadsigns())->dailyAt('01:40');
        $schedule->job(new GenerateCsvFiles())->dailyAt('02:10');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
