<?php

namespace App\Models\Realty;

use Illuminate\Database\Eloquent\Model;

class RealtyComfort extends Model
{

    protected $table = 'realty_comfort';
    protected $fillable = [
        'name', 'icon'
    ];
    public $timestamps = false;

    public function cat() {
        return $this->hasOne('App\Models\Realty\RealtyComfortCat', 'id', 'cat_id');
    }

}
