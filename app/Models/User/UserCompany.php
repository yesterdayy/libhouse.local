<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserCompany extends Model
{

    protected $table = 'users_company_info';

    protected $fillable = ['id', 'field', 'value'];

    public $timestamps = false;

    /*
     * *******************************************************
     * RelationShips
     * *******************************************************
     */

    public function attachments()
    {
        return $this->belongsToMany('App\Models\Blog\Attachments', 'users_company_attachments', 'company_id', 'attachment_id')->withPivot('type', 'is_moderated');
    }

}
