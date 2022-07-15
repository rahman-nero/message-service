<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'content' => 'required|min:8|string'
        ];
    }
}
