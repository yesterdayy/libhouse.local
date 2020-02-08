<?php

namespace App\Models\Email;

use Illuminate\Database\Eloquent\Model;
use PHPMailer\PHPMailer\PHPMailer;

class EmailQueue extends Model
{

    protected $table = 'email_queue';

    protected $fillable = [
        'email_account_id', 'to_email', 'subject', 'message', 'is_sent'
    ];

    public static function send(EmailQueue $email) {
        $mail = new PHPMailer(true);
        $mail->CharSet = "UTF-8";
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $email->account->email;
        $mail->Password = $email->account->password;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($email->account->email);
        $mail->addAddress($email->to_email);
        $mail->Subject = $email->subject;
        $mail->Body = $email->message;
        $mail->isHTML(true);

        return $mail->send();
    }

    /*
     * *******************************************************
     * RelationShips
     * *******************************************************
     */

    public function account() {
        return $this->hasOne('App\Models\Email\EmailAccount', 'id', 'email_account_id');
    }

}
