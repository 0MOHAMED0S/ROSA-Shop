<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
{
    return [
        'code' => ['required', 'array', 'size:4'],
        'code.*' => ['required', 'digits:1'], 
    ];
}

}
