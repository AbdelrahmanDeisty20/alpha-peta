<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            "name" => [
                "required",
                "regex:/^[\p{Arabic}a-zA-Z\s]{2,}$/u",
                "max:50"
            ],
            "email" => [
                "required",
                "email:rfc,dns",
            ],
            'message' => 'required|min:3|max:255',
        ];
    }
    public function messages(): array
{
    return [
        "name.required" => "The name is required.",

        "email.required" =>__("The email address is required."),
        "email.email" => __("Please enter a valid email address."),
        "message.required" => __("The message is required."),
        "message.min" => __("The message must contain at least 3 characters."),
        "message.max" => __("The message must not exceed 255 characters."),

    ];
}
}
