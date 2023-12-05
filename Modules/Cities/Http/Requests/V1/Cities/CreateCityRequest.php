<?php

namespace App\Http\Requests\V1\Cities;

use Illuminate\Foundation\Http\FormRequest;;

class CreateCityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
