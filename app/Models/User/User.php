<?php

namespace App\Models\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
     * *******************************************************
     * RelationShips
     * *******************************************************
     */

    public function info()
    {
        return $this->hasMany('App\Models\User\UserInfo', 'user_id');
    }

    public function company()
    {
        return $this->belongsToMany('App\Models\User\UserCompany', 'users_company', null, 'company_id');
    }

    public function realty_type_info()
    {
        return $this->hasOne('App\Models\User\UserRealtyType', 'id', 'realty_type');
    }

    public function realty_comment_rating()
    {
        return $this->hasOne('App\Models\Realty\RealtyUserCommentRating', 'author_id', 'id');
    }

}
