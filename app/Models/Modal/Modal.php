<?php

namespace App\Models\Modal;

use Illuminate\Database\Eloquent\Model;

class Modal extends Model
{

    protected $table = 'modals';
    protected $fillable = ['title', 'content', 'selector', 'trigger', 'status', 'author_id'];

}
