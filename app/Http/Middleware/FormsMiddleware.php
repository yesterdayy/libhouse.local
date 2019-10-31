<?php

namespace App\Http\Middleware;

use App\Models\Forms\Form;
use App\Rules\PhoneNumber;
use Closure;
use Illuminate\Support\Facades\Validator;

class FormsMiddleware
{

    private $validation_rules = [
        'text' => 'sometimes|string|max:100',
        'email' => 'sometimes|email|max:100',
        'textarea' => 'sometimes|string|max:3000',
        'file' => 'sometimes|file|max:8000',
        'pay-btn' => [
            'check' => 'sometimes|file|max:8000',
        ],
        'contact-btn' => [
            'email' => 'sometimes|required|email|max:100',
            'viber' => ['sometimes', 'required', 'numeric'],
            'whatsapp' => ['sometimes', 'required', 'numeric'],
            'telegram' => 'sometimes|required|string|max:50',
        ],
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Валидация форм
        $form_id = $request->get('form_id');
        if ($form_id) {
            $this->validation_rules_init();
            $this->form_validation($form_id, $request);
        }

        return $next($request);
    }

    // Функция валидации форм
    private function form_validation($form_id, $request) {
        $fields = Form::find($form_id)->fields()->get();

        if ($fields->count() > 0) {

            $validator_array = [];
            foreach ($fields as $field) {
                if (isset($this->validation_rules[$field->type])) {
                    if (is_array($this->validation_rules[$field->type])) {
                        $validator_array = array_merge($validator_array, $this->validation_rules[$field->type]);
                    } else {
                        $validator_array[$field->name] = $this->validation_rules[$field->type] . (isset($field->is_required) ? '|required' : '');
                    }
                }
            }

            $validator = Validator::make($request->all(), $validator_array);
            $validator->validate();
        }
    }

    // Вставка Rules вместо строк
    private function validation_rules_init() {
        $this->validation_rules['contact-btn']['viber'][] = new PhoneNumber;
        $this->validation_rules['contact-btn']['whatsapp'][] = new PhoneNumber;
    }
}
