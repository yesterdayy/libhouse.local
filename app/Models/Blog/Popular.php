<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class Popular extends Model
{

    protected $table = 'blog_popular_index';

    public $primaryKey = 'entry_id';

    public $timestamps = false;

    protected $fillable = array('entry_id', 'date', 'index');

}
