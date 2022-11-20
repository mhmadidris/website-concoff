<?php

namespace App\Console;

use App\Models\Transaction;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $transactionSche = Transaction::where('date_end', '<', now())->update([
                'status_transaksi' => 'Success',
            ]);

            if ($transactionSche->status_transaksi == 'Success') {
                return redirect()->back()->withToastSuccess('Selamat barang anda sudah sampai!');
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
