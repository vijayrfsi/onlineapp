<?php

namespace App\Http\Requests\V1\Districts;

use Illuminate\Foundation\Http\FormRequest;;

class CreateDistrictRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
