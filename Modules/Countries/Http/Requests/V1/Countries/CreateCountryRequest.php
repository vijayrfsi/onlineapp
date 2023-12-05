<?php

namespace App\Http\Requests\V1\Countries;

use Illuminate\Foundation\Http\FormRequest;;

class CreateCountryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
