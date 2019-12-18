<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserRealtyFavorite extends Model
{

    protected $table = 'realty_favorite';
    public $fillable = ['user_id', 'realty_id', 'created_at'];
    public $timestamps = false;

}
