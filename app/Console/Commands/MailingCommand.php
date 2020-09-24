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
    public function handle()
    {
        $users = User::pluck('email');

        if (!$users) {
            return 1;
        }

        foreach ($users as $user) {
            Mail::to($user)->send(new WeeklyMailing);
        }

        return 0;
    }
}
