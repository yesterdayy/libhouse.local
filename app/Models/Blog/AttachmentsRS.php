<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class AttachmentsRS extends Model
{

    protected $table = 'blog_entry_attachments';

    public $primaryKey = 'entry_id';

    public $timestamps = false;

    protected $fillable = array('entry_id', 'type', 'attachment_id');

}
