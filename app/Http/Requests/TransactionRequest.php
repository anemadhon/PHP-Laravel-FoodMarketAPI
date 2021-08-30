<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'food_id' => ['required', 'exists:foods,id'],
            'user_id' => ['required', 'exists:users,id'],
            'quantity' => ['required'],
            'total' => ['required'],
            'status' => ['required'],
            'payment_url' => ['string']
        ];
    }
}
