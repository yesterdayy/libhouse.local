<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $files = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($files = null)
    {
        if ($files) {
            foreach ($files as $file) {
                $this->files[] = Storage::disk('public')->path($file->store('mails', 'public'));
            }
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->view('mail')->from('yesterdayy@ya.ru', 'Yura');
        if (count($this->files) > 0) {
            foreach ($this->files as $file) {
                $mail = $mail->attach($file);
            }
        }
        return $mail;
    }
}
