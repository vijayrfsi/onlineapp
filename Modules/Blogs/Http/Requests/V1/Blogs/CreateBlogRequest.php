<?php

namespace App\Http\Requests\V1\Blogs;

use Illuminate\Foundation\Http\FormRequest;;

class CreateBlogRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
