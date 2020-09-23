<?php

namespace App\Console\Commands;

use App\Mail\WeeklyMailing;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MailingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:mailing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Почтовая рассылка';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    // TODO: правильно я понимаю, что если написать без цикла таким образом:
    /** Mail::to(User::pluck('email'))->send(new WeeklyMailing); */
    // TODO: то у каждого в письме отобразится список получателей?
    public function handle()
    {
        $users = User::pluck('email');

        if (!$users || count($users) === 0) {
            // TODO: существуют ли какие-то стандарты о том,
            // TODO: какой код возвращать в случае той или иной ошибки?
            return 1;
        }

        foreach ($users as $user) {
            Mail::to($user)->send(new WeeklyMailing);
        }

        return 0;
    }
}
