<?php

namespace App\Models\Realty;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RealtyRentDuration extends Model
{

    protected $table = 'realty_rent_duration';
    public $fillable = ['name'];
    public $timestamps = false;

    const EMPTY_DURATION_ID = 0;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('not_empty_type', function (Builder $builder) {
            $builder->whereKeyNot(self::EMPTY_DURATION_ID);
        });
    }

}
