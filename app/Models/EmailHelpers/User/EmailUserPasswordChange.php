<?php

namespace App\Models\EmailHelpers\User;

use App\Models\Email\EmailQueue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class EmailUserPasswordChange extends Model
{

    protected $table = 'users_password_change';

    protected $fillable = [
        'user_id', 'token', 'is_done', 'expired'
    ];

    public $timestamps = false;

    private static $valid_token;

    const SECRET = 'libhouse-secret-word';
    const EMAIL_QUEUE_TYPE_ID = 1;
    const EMAIL_SUBJECT_TEXT = 'Сброс пароля';

    public static function add_to_queue($email) {
        $user = User::where('email', $email)->first();

        if (empty($user)) {
            return false;
        }

        $token_exists = EmailUserPasswordChange::select('token')
            ->where('user_id', $user->id)
            ->where('is_done', 0)
            ->where('expired', '>', Carbon::now())->first();

        if (!$token_exists) {
            $token = self::generate_token();

            EmailUserPasswordChange::create([
                'user_id' => $user->id,
                'token' => $token,
                'expired' => Carbon::now()->addHours(2),
            ]);
        } else {
            $token = $token_exists->token;
        }

        $user_name = $user->last_name . ' ' . $user->first_name;

        $message = view('email_templates.user.reset_password', compact('user_name', 'token'))->render();

        EmailQueue::create([
            'email_account_id' => self::EMAIL_QUEUE_TYPE_ID,
            'to_email' => $email,
            'subject' => self::EMAIL_SUBJECT_TEXT,
            'message' => $message,
        ]);

        return true;
    }

    public static function getToken(string $token) {
        $token = EmailUserPasswordChange::where('token', $token)
            ->where('is_done', 0)
            ->where('expired', '>', Carbon::now())->first();

        return $token;
    }

    public static function useTokens(int $user_id):bool {
        return EmailUserPasswordChange::where('user_id', $user_id)
            ->where('is_done', 0)
            ->where('expired', '>', Carbon::now())
            ->update(['is_done' => 1]);
    }

    private static function generate_token() {
        return md5(Auth::id() . microtime() . self::SECRET);
    }

}
