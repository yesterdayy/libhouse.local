<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserSubscribe extends Model
{

    protected $table = 'users_subscribe';
    protected $fillable = ['user_id'];
    public $timestamps = false;

}
