<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{

    protected $table = 'users_info';

    protected $fillable = ['user_id', 'field', 'value'];

    public $timestamps = false;

}
