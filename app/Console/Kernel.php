<?php

namespace App\Console;

use App\Http\Controllers\AbsensiController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            // Memanggil fungsi reset absensi setiap minggu
            app(AbsensiController::class)->store();
        })->weeklyOn(1, '00:00'); // Setiap Senin tengah malam
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
