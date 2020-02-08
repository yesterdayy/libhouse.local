<?php

namespace App\Models\Email;

use Illuminate\Database\Eloquent\Model;

class EmailAccount extends Model
{

    protected $table = 'email_accounts';

    protected $fillable = [
        'name', 'email', 'password'
    ];

}
