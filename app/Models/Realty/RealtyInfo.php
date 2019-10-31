<?php

namespace App\Models\Realty;

use Illuminate\Database\Eloquent\Model;

class RealtyInfo extends Model
{

    protected $table = 'realty_entry_info';
    protected $fillable = [
        'realty_id', 'field', 'value'
    ];
    public $timestamps = false;

}
