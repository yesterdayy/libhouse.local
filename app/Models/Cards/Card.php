<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{

    protected $table = "price_cards";

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

}
