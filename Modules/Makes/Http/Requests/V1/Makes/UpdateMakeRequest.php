<?php

namespace App\Http\Requests\V1\Makes;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMakeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
