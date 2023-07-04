<?php

namespace App\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            Log::info('Running cron job');
            $now = strtotime(now('Europe/Paris'));
            // find all reservations
            $reservations = DB::table('reservations')->get();
            // loop through all reservations
            if($reservations->count() > 0) {
                foreach ($reservations as $reservation) {
                    // if the reservation is not confirmed and the reservation time is less than 30 minutes away
                    if ($reservation->end_at < $now) {
                        // unreserve the room
                        Log::info('Unreserving room '.$reservation->room);
                        return DB::table('rooms')->where('id', $reservation->room)->update(['is_reserved' => false]);
                    }
                    Log::info('No reservations to unreserve');
                    return;
                }
            } else {
                Log::info('No reservations found');
            }
        })->everyMinute()->sendOutputTo(storage_path('logs/cron.log'));
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
