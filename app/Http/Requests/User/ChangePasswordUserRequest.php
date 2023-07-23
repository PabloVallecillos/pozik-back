<?php

namespace App\Http\Requests\User;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'old_password' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('The current password is incorrect.');
                    }
                },
            ],
            'new_password' => ['required', 'string', 'max:255', 'min:8'],
            'copy_new_password' => ['required', 'string', 'max:255', 'same:new_password', 'min:8'],
        ];
    }
}
