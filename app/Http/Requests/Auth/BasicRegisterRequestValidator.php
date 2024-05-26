<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Responses\Errors;
use Error;
use Illuminate\Foundation\Http\FormRequest;

class BasicRegisterRequestValidator extends FormRequest
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
            "name" => "required|string",
            "last_name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|string",
            "confirm_password" => "required|string|same:password"
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            "name.required" => Errors::NAME_REQUIRED,
            "name.string" => Errors::NAME_STRING,

            "last_name.required" => Errors::LAST_NAME_REQUIRED,
            "last_name.string" => Errors::LAST_NAME_STRING,

            "email.required" => Errors::EMAIL_REQUIRED,
            "email.email" => Errors::EMAIL_TYPE,
            "email.unique" => Errors::EMAIL_UNIQUE,

            "password.required" => Errors::PASSWORD_REQUIRED,
            "password.string" => Errors::PASSWORD_STRING,

            "confirm_password.required" => Errors::CONFIRM_PASSWORD_REQUIRED,
            "confirm_password.string" => Errors::PASSWORD_STRING,

            "confirm_password.same" => Errors::CONFIRM_PASSWORD_SAME,

        ];
    }
}
