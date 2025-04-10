<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return $this->rulesForCreate();
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            return $this->rulesForUpdate();
        }
        return [];
    }
    protected function rulesForCreate(): array
    {
        return [
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0|max:999999.99',
            'discount' => 'nullable|integer',
            'section_id' => 'required|exists:sections,id',
            'path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    protected function rulesForUpdate(): array
    {
        $productId = $this->route('id');
        return [
            'name' => 'required|string|max:255|unique:products,name,' . $productId,
            'description' => 'required|string',
            'price' => 'required|numeric|min:0|max:999999.99',
            'discount' => 'nullable|integer|min:0',
            'section_id' => 'required|exists:sections,id',
            'path' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
