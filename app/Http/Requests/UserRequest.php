<?php

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    use PasswordValidationRules;
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
        $rules = User::VALIDATION_RULES;

        $id = $this->getRequestUri() == '/api/user' ? $this->user()->id : $this->user->id;

        if ($this->getMethod() == 'POST') return $rules += ['password' => $this->passwordRules()];

        if ($this->getMethod() == 'PUT')
        {
            $rules['username'][2] = 'unique:users,username,' . $id;
            $rules['email'][3] = 'unique:users,email,' .  $id;
    
            return $rules;
        }
    }
}
