<?php

namespace blog\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \blog\Console\Commands\gettraindata::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $start = Carbon::now()->subMinutes(10)->format('Y-m-d\TH:i:s');
        $end = Carbon::now()->subMinutes(9)->format('Y-m-d\TH:i:s');
        $schedule->command('gettraindata', [$start, $end, '0', '--method'=>'insert'])->everyMinute();;
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
