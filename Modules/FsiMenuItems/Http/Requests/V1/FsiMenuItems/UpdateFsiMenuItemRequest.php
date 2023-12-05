<?php

namespace App\Http\Requests\V1\FsiMenuItems;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFsiMenuItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
