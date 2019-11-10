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
            'address_street' => 'numeric|nullable',
            'youtube.*' => 'max:535|nullable',
            'content' => 'required|max:3000',
            'price' => 'numeric|nullable',
            'price' => 'required|integer',
            'info.floor' => 'required|integer',
            'info.floors' => 'required|integer',
            'info.square_common' => 'integer|nullable',
            'info.square_living' => 'integer|nullable',
            'info.square_kitchen' => 'integer|nullable',
        ];
    }

}
