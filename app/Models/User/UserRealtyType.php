<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserRealtyType extends Model
{

    protected $table = 'users_realty_type';

    const EMPTY_TYPE = 0;

}
