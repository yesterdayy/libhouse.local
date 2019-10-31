<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class TagsRS extends Model
{

    protected $table = 'blog_entry_tags';

    public $primaryKey = 'tag_id';

    public $timestamps = false;

    protected $fillable = array('tag_id', 'entry_id');

}
