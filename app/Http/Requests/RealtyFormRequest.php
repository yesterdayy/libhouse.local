<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RealtyFormRequest extends FormRequest
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
            'user_realty_type' => 'required|integer',
            'trade_type' => 'required|integer',
            'duration' => 'required|integer',
            'dop_type' => 'required|integer',
            'rent_type' => 'required|integer',
            'type' => 'required|integer',
            'room_type' => 'required|integer',
            'address_city' => 'required|numeric',
            'address_street' => 'numeric',
            'youtube' => 'max:535',
            'content' => 'max:3000',
            'price' => 'numeric',
            'info[floor]' => 'required|integer',
            'info[floors]' => 'required|integer',
            'info[common_square]' => 'integer',
            'info[living_square]' => 'integer',
            'info[kitchen_square]' => 'integer',
        ];
    }
}
