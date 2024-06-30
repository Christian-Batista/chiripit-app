<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
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
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'location' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
            'availability' => 'nullable|boolean',
        ];
    }

    public function toProfileDataRequest()
    {
        return new \App\Data\ProfileData($this->validated());
    }
}
