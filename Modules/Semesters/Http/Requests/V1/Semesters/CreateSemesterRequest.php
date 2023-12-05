<?php

namespace App\Http\Requests\V1\Semesters;

use Illuminate\Foundation\Http\FormRequest;;

class CreateSemesterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
