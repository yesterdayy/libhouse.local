<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;

class MenuList extends Model
{

    protected $table = 'blog_menu_list';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'icon',
        'link',
        'class',
        'order',
        'menu_id',
    ];

    protected $appends = [
        'url'
    ];

    public function getUrlAttribute()
    {
        return $this->attributes['link'];
    }

    public function menu()
    {
        return $this->belongsTo('App\Menu', 'menu_id', 'id');
    }

    public function entry()
    {
        return $this->hasOne('App\Models\Blog\Post', 'slug', 'link')->where('status', 'published')->whereIn('type', ['post', 'page']);
    }

}
