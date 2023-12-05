<?php

namespace App\Http\Requests\V1\Departments;

use Illuminate\Foundation\Http\FormRequest;;

class CreateDepartmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
