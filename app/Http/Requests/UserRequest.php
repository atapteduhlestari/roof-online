<?php

namespace App\Http\Requests;

use GuzzleHttp\Psr7\Request;
use App\Rules\SpecialCharacter;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => ['required', new SpecialCharacter],
            'sbu_id' => 'required',
            'username' => ['required', Rule::unique('users')->ignore($this->user, 'id')],
            'email' => ['required', 'email:rfc', Rule::unique('users')->ignore($this->user, 'id')],
            'password' => 'nullable|min:6',
            'active' => 'required',
        ];

        if ($this->isMethod('POST'))
            $rules['password'] = 'required|min:6';

        return $rules;
    }
}
