<?php

namespace App\Console;

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
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // TODO: на сколько корректна запись в кронтаб с указанием пути от тильды, т.е. вида: ~/www/skillbox/...
        // TODO: как я понимаю, на сервере из-за такой запись могут возникнуть проблемы,
        // TODO: т.к. может быть рут пользователь и пользователь на котором лежит проект

        // TODO: и еще вопрос, подтянетеся ли сюда таймзона из конфигураций?
        // TODO: или тут отдельно нужно очевидно ее указать?
        $schedule->command('cron:mailing')->mondays()->at('18:30');
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
