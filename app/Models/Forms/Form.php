<?php

namespace App\Models\Forms;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{

    protected $table = "forms";

    public static function getForm($id) {
        $form = Form::with('fields')->find($id);
        if (!empty($form)) {
            $form_fields = $form->fields;
            if (!empty($form_fields)) {
                ob_start();
                $html = view('core.form', compact('form', 'form_fields'));
                return $html->render();
            }
        }
        return false;
    }

    public function fields() {
        return $this->hasMany('App\Models\Forms\FormFields', 'form_id', 'id')->orderBy('order', 'ASC');
    }

    public function templates() {
        return $this->hasMany('App\Models\Forms\FormTemplates', 'form_id', 'id');
    }

    public static function form_shortcode($args) {
        if ($args['id'] && is_numeric($args['id'])) {
            return Form::getForm($args['id']);
        } else {
            return '';
        }
    }

}
