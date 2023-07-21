<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'front_version' => 'nullable|string|max:20',
            'platform' => 'nullable|string|max:10',
            'device' => 'nullable|string|max:255',
        ];
    }
}
