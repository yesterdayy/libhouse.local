<?php

namespace App\Models\Realty;

use Illuminate\Database\Eloquent\Model;

class RealtyCounters extends Model
{

    protected $table = 'realty_counters';
    public $timestamps = false;
    public $primaryKey = 'realty_id';
    protected $fillable = ['realty_id', 'counter'];

}
