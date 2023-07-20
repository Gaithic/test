<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSurveyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required|integer',
            'role' => 'required',
            'g1' => 'required',
            'feature' => 'required',
            'skill_suggestion' => 'required|array',
            'skill_suggestion.*' => 'string',
            'suggestion' => 'required|string',
        ];
    }
}
