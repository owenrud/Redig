<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\event;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{

    public function updateEventStatus()
{
    // Get the current date
    $currentDate = Carbon::today();
    
    // Get events where the current date is bigger than event.start and status is 0
    $eventsToUpdateStart = Event::where('start', '<=', $currentDate)
        ->where('status', 2)
        ->get();

    // Update status to 1 for events where start date condition is met
    foreach ($eventsToUpdateStart as $event) {
        $event->status = 1;
        $event->save();
    }

    // Get events where the current date is bigger than event.end and status is 1
    $eventsToUpdateEnd = Event::where('end', '<', $currentDate)
        ->where('status', 1)
        ->get();

    // Update status to 0 for events where end date condition is met
    foreach ($eventsToUpdateEnd as $event) {
        $event->status = 0;
        $event->save();
    }
}

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
         //$schedule->command('inspire')->hourly();
        //$schedule->command(DailyEvent::class)->daily();
        $schedule->call(function () {
            // Call the updateEventStatus() function
            $this->updateEventStatus();
        })->everyMinute();// Run the task daily
    
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
