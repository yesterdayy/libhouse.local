<?php

namespace App\Models\Forms;

use Illuminate\Database\Eloquent\Model;

class FormClients extends Model
{

    protected $table = 'form_clients';

    protected $fillable = array('email', 'form_id');
    protected $guarded = array('id', 'created_at', 'updated_at');

}
