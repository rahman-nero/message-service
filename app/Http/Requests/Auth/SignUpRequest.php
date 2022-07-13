<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

final class SignUpRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'name'=> 'required|string|min:3',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|string|min:6|confirmation',
        ];
    }
}
