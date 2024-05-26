<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Responses\Errors;
use Illuminate\Foundation\Http\FormRequest;

class BasicLoginRequestValidator extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            "password" => "required|string",
        ];
    }

    public function messages(): array
    {
        return [
            "email.required" => Errors::EMAIL_REQUIRED,
            "email.email" => Errors::EMAIL_TYPE,
            "email.exists" => Errors::EMAIL_UNIQUE,

            "password.required" => Errors::PASSWORD_REQUIRED,
            "password.string" => Errors::PASSWORD_STRING
        ];
    }
}
