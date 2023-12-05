<?php

namespace App\Http\Requests\V1\Marks;

use Illuminate\Foundation\Http\FormRequest;;

class CreateMarkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
