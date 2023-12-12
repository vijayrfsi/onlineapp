<?php

namespace App\Http\Requests\V1\Degrees;

use Illuminate\Foundation\Http\FormRequest;;

class CreateDegreeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
