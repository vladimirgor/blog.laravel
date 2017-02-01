<?php

namespace App\Console;
use App\ConfirmUsers;
use App\User;
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
        // Commands\Inspire::class,
        \App\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {
            ConfirmUsers::where('updated_at','<',date('Y-m-d H:i:s',
                strtotime('-1 hours')
                //strtotime('-5 minutes')
            ))->delete();
            User::where('updated_at','<',date('Y-m-d H:i:s',
                strtotime('-1 hours')
                //strtotime('-5 minutes')
            ))->where('status','=',0)->delete();
       })->everyMinute();
    }
}
// в (cron) планировщик заданий  - выполнить
//php "c:\OpenServer\domains\blog.laravel\artisan" schedule:run
// или
//php c:\OpenServer\domains\blog.laravel\artisan schedule:run
// c 1>> /dev/null 2>&1 не работает
//или
//php %sitedir%\blog.laravel\artisan schedule:run
// c >> /dev/null 2>&1 не работает
//%progdir%\modules\php\%phpdriver%\php-win.exe -c %progdir%\userdata\temp\config\php.ini -q -f %sitedir%\sitename.com\cron.php
//%progdir%\modules\wget\bin\wget.exe -q --no-cache http://sitename.com/cron.php -O %progdir%\userdata\temp\temp.txt