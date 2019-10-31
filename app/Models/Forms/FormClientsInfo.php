<?php

namespace App\Models\Forms;

use Illuminate\Database\Eloquent\Model;

class FormClientsInfo extends Model
{

    protected $table = 'form_clients_info';

    public $timestamps = false;

    protected $fillable = array('client_id', 'field', 'value');

}
