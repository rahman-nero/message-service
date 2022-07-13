<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

final class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'login'=> 'required|email|exists:users,email',
            'password'=> 'required|string|min:6',
        ];
    }
}
