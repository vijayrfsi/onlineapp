<?php

namespace App\Http\Requests\V1\Classes;

use Illuminate\Foundation\Http\FormRequest;;

class CreateClassRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
