<?php

namespace App\Http\Requests\V1\States;

use Illuminate\Foundation\Http\FormRequest;;

class CreateStateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
