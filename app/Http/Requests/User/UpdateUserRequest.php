<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_email' => 'email|unique:users|exists:users',
            'name' => 'string|max:255',
            'surname' => 'string|max:255',
            'email' => 'email|unique:users',
            'password' => 'min:8|max:255',
            'front_version' => 'string|max:20',
            'platform' => 'string|max:10',
            'device' => 'string|max:255',
            'fcm_token' => 'string|max:255',
            'last_activity' => 'date',
        ];
    }
}
