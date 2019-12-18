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
        'last_name', 'first_name', 'email', 'password', 'phone', 'realty_type_id'
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

    public function realty_type()
    {
        return $this->hasOne('App\Models\User\UserRealtyType', 'id', 'realty_type_id');
    }

    public function realty_comment_rating()
    {
        return $this->hasOne('App\Models\Realty\RealtyUserCommentRating', 'author_id', 'id');
    }

    /*
     * *******************************************************
     * Shortcodes
     * *******************************************************
     */

    public static function login_form_shortcode($args) {
        return view('auth/login');
    }

    public static function register_form_shortcode($args) {
        return view('auth/register');
    }

    public static function reset_password_shortcode($args) {
        return view('auth/passwords/email');
    }

}
