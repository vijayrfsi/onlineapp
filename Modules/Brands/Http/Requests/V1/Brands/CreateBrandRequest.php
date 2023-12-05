<?php

namespace App\Http\Requests\V1\Brands;

use Illuminate\Foundation\Http\FormRequest;;

class CreateBrandRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
