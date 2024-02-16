<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Event;
use Carbon\Carbon;

class DailyEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get the current date
        $currentDate = Carbon::now()->toDateString();

        Event::where('start', '<', $currentDate)
        ->update(['status' => 1]);
        // Update the status of events where the end date is in the past
        Event::where('end', '<', $currentDate)
            ->update(['status' => 0]);

        $this->info('Event statuses updated successfully.');
    }
}
