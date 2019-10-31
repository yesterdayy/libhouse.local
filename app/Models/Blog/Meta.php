<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{

    protected $table = 'blog_entry_meta';
    protected static $table_public = 'blog_entry_meta';

    protected $primaryKey = 'meta_id';

    public $timestamps = false;

    protected $fillable = array('entry_id', 'field', 'value');
    protected $guarded = array('meta_id');

    public static function getTableName() {
        return self::$table_public;
    }

}
