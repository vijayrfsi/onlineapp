<?php

namespace App\Http\Requests\V1\Subjects;

use Illuminate\Foundation\Http\FormRequest;;

class CreateSubjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
