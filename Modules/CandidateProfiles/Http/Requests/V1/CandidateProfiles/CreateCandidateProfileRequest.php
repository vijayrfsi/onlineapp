<?php

namespace App\Http\Requests\V1\CandidateProfiles;

use Illuminate\Foundation\Http\FormRequest;;

class CreateCandidateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }
}
