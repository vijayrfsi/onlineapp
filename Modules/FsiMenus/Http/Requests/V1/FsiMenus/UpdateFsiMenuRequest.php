<?php

namespace App\Http\Requests\V1\FsiMenus;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFsiMenuRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
