<?php

namespace App\Jobs;

use App\Events\ReportRequested;
use App\Mail\ReportMail;
use App\Service\PrepareReport;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
use Mail;

class Reports implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $toReport;
    private string $mail;

    /**
     * Create a new job instance.
     * @param array $toReport
     * @param string $mail
     */
    public function __construct(array $toReport, string $mail)
    {
        $this->toReport = $toReport;
        $this->mail = $mail;
    }

    /**
     * Execute the job.
     *
     * @return MailMessage
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function handle()
    {
        $filename = (new PrepareReport($this->toReport))->getReport();

//        event(new ReportRequested(auth()->user()));

        return Mail::to($this->mail)->send(new ReportMail($filename));
    }

    /**
     * На провал работы пишет лог
     * @param Exception $exception
     */
    public function failed(Exception $exception)
    {
        Log::error($exception->getMessage());
    }
}
