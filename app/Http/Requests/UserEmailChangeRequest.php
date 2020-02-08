<?php

namespace App\Http\Requests;

use App\Rules\EmailRFC;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserEmailChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'new_email' => ['required', Rule::unique('users', 'email')->ignore($this->user()->id, 'id'), new EmailRFC],
        ];
    }
}
