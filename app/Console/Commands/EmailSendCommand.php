<?php

namespace App\Console\Commands;

use App\Models\Email\EmailQueue;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use PHPMailer\PHPMailer\PHPMailer;

class EmailSendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $emails = EmailQueue::with('account')->where('is_sent', 0)->get();

        if (!empty($emails)) {
            foreach ($emails as $email) {
                if (EmailQueue::send($email)) {
                    $email->is_sent = 1;
                    $email->save();
                }

                sleep(3);
            }
        }
    }
}
