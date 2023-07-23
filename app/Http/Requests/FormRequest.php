<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as ParentFormRequest;

class FormRequest extends ParentFormRequest
{
    public function authorize(): bool
    {
        return (bool) auth()?->check();
    }
}
