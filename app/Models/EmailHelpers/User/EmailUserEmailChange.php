<?php

namespace App\Models\EmailHelpers\User;

use App\Models\Email\EmailQueue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;

class EmailUserEmailChange extends Model
{

    protected $table = 'users_email_change';

    protected $fillable = [
        'user_id', 'new_email', 'token', 'is_done', 'expired'
    ];

    public $timestamps = false;

    private static $valid_token;

    const SECRET = 'libhouse-secret-word';
    const EMAIL_QUEUE_TYPE_ID = 1;
    const EMAIL_SUBJECT_TEXT = 'Смена email';

    public static function add_to_queue($new_email) {
        $token_exists = EmailUserEmailChange::select('token')
                                       ->where('user_id', Auth::id())
                                       ->where('new_email', $new_email)
                                       ->where('is_done', 0)
                                       ->where('expired', '>', Carbon::now())->first();

        if (!$token_exists) {
            $token = self::generate_token();

            EmailUserEmailChange::create([
                'user_id' => Auth::id(),
                'new_email' => $new_email,
                'token' => $token,
                'expired' => Carbon::now()->addHours(2),
            ]);
        } else {
            $token = $token_exists->token;
        }

        $user_name = Auth::user()->last_name . ' ' . Auth::user()->first_name;

        $message = view('email_templates.user.change_email', compact('user_name', 'token'))->render();

        EmailQueue::create([
            'email_account_id' => self::EMAIL_QUEUE_TYPE_ID,
            'to_email' => $new_email,
            'subject' => self::EMAIL_SUBJECT_TEXT,
            'message' => $message,
        ]);
    }

    public static function isValidToken(int $user_id, string $token):bool {
        $token = EmailUserEmailChange::where('token', $token)
            ->where('user_id', $user_id)
            ->where('is_done', 0)
            ->where('expired', '>', Carbon::now());

        self::$valid_token = $token->first();

        return (bool) $token->count();
    }

    public static function useLastValidToken(User $user):bool {
        $token = self::$valid_token;
        $token->is_done = 1;
        $token->save();

        $user->email = $token->new_email;
        return $user->save();
    }

    public static function unActiveOtherUserTokens(int $user_id):bool {
        return EmailUserEmailChange::where('user_id', $user_id)
            ->where('is_done', 0)
            ->where('expired', '>', Carbon::now())
            ->update(['is_done' => 1]);
    }

    private static function generate_token() {
        return md5(Auth::id() . microtime() . self::SECRET);
    }

}
