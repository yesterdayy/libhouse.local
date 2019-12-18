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
            'term' => 'max:300|nullable',
            'user_realty_type' => 'required|integer',
            'trade_type' => 'required|integer',
            'duration' => 'required|integer',
            'dop_type' => 'required|integer',
            'rent_type' => 'required|integer',
            'type' => 'required|integer',
            //'room_type' => 'required|integer',
            'house_class' => 'nullable|integer',
            'address_city' => 'required|numeric',
            'address_street' => 'required|numeric',
            'photos' => 'required|array|min:3',
            'youtube.*' => 'max:535|nullable',
            'title' => 'nullable|max:300',
            'content' => 'required|max:3000',
            'price' => 'numeric|nullable',
            'info.floor' => 'required|integer',
            'info.floors' => 'required|integer',
            'info.square_common' => 'integer|nullable',
            'info.square_living' => 'integer|nullable',
            'info.square_kitchen' => 'integer|nullable',
            'info.comission' => 'integer|nullable',
            'sort' => 'max:20|nullable',
        ];
    }

}
