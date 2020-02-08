<?php

namespace App\Models\EmailHelpers\User;

use App\Models\Email\EmailQueue;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EmailUserRegister
{

    public $timestamps = false;

    const SECRET = 'libhouse-secret-word';
    const EMAIL_QUEUE_TYPE_ID = 1;
    const EMAIL_SUBJECT_TEXT = 'Регистрация';

    public static function add_to_queue($user) {
        if (empty($user)) {
            return false;
        }

        $message = view('email_templates.user.register_welcome', compact('user'))->render();

        EmailQueue::create([
            'email_account_id' => self::EMAIL_QUEUE_TYPE_ID,
            'to_email' => $user->email,
            'subject' => self::EMAIL_SUBJECT_TEXT,
            'message' => $message,
        ]);

        return true;
    }

}
