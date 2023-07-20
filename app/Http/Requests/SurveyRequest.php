<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

class SurveyRequest extends FormRequest
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
            'name'              => 'required',
            'email'             => 'required|email',
            'role'              => 'required',
            'g1'                => 'required',
            'feature'           => 'required',
            'skill_suggestion'  => 'required',
            'suggestion'        => 'required'
        ];
    }

    /**
     * Get the validation messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'             => 'Please enter your name.',
            'email.required'            => 'Please enter your email address.',
            'email.email'               => 'Please enter a valid email address.',
            'role.required'             => 'Please select your role.',
            'g1.required'               => 'Please provide an answer to the first question.',
            'feature.required'          => 'Please select a feature you like the most.',
            'skill_suggestion.required' => 'Please provide a skill suggestion.',
            'suggestion'                => 'Please provide your suggestion'
        ];
    }

        /**
     * Get the validation error response in JSON format.
     *
     * @param  Validator  $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
