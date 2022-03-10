<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartItemRequest extends FormRequest
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
            'tesco_id' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'image' => ['required', 'string'],
            'department' => ['string'],
            'description' => ['string'],
            'price' => ['numeric', 'between:0,999.99'],
            'quantity' => ['integer'],
        ];
    }
}
