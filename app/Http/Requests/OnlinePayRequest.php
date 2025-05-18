<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OnlinePayRequest extends FormRequest
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
            'address' => 'required|string|min:5|max:255',
            'shipping_data.first_name' => 'required|string|min:2|max:50',
            'shipping_data.last_name' => 'required|string|min:2|max:50',
            'shipping_data.phone_number' => [
                'required',
                'string',
                'regex:/^(\+20|0)?1[0-9]{9}$/',
            ],
        ];
    }
}
