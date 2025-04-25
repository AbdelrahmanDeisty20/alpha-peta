<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderService extends FormRequest
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
                "max:50"
            ],
            "email" => [
                "required",
                "email:rfc,dns",
            ],
            "phone" => [
                "required",
                "digits_between:9,15",
                ' regex: /^\d+$/'
            ],
            'message' => 'required|min:3|max:255',
            "subject"=>"required|min:3|max:50",

            'code_vervication' =>'required',
        ];
    }

        public function messages()
        {
            return [
                "name.required" => __("The name is required."),
                "name.regex" => __("The name must contain at least two letters in Arabic or English and cannot contain numbers or special characters."),
                "name.max" => __("The name must not exceed 50 characters."),

                "email.required" => __("The email address is required."),
                "email.email" => __("Please enter a valid email address."),

                "phone.required" => __("The phone number is required."),
                "phone.digits_between" => __("The phone number must be between 9 and 15 digits."),
                "phone.regex" => __("The phone number must contain only numbers."),

                "message.required" => __("The message is required."),
                "message.min" => __("The message must contain at least 3 characters."),
                "message.max" => __("The message must not exceed 255 characters."),

                "subject.required" => __("The subject is required."),
                "subject.min" => __("The subject must contain at least 3 characters."),
                "subject.max" => __("The subject must not exceed 50 characters."),
            ];
        }
}
