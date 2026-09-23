<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lte:price'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'tests' => ['nullable', 'array'],
            'tests.*' => ['integer', 'exists:tests,id'],
            'remove_image' => ['nullable', 'boolean'],
        ];
    }
}
