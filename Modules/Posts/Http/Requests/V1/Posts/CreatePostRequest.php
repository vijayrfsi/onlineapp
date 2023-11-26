<?php

namespace App\Http\Requests\V1\Posts;

use Illuminate\Foundation\Http\FormRequest;;

class CreatePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
