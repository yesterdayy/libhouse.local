<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class CatsRS extends Model
{

    protected $table = 'blog_entry_cats';

    public $primaryKey = 'cat_id';

    public $timestamps = false;

    protected $fillable = array('cat_id', 'entry_id');

}
