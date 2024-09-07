<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // تعريف الأوامر المخصصة هنا
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // جدولة الأوامر هنا

        // مثال: تشغيل الأمر 'inspire' كل ساعة
        $schedule->command('inspire')->hourly();

        // مثال: تشغيل الوظيفة في كل يوم في منتصف الليل
        $schedule->call(function () {
            // أضف الكود الذي تريد تشغيله هنا
        })->daily();

        // مثال: تشغيل الأمر المخصص كل أسبوع
        $schedule->command('custom:command')->weekly();
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
