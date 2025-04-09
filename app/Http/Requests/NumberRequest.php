<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NumberRequest extends FormRequest
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
            'face' => ['required', 'integer', 'min:0'],
            'insta' => ['required', 'integer', 'min:0'],
            'tik' => ['required', 'integer', 'min:0'],
            'orders' => ['required', 'integer', 'min:0'],
        ];
    }
}
