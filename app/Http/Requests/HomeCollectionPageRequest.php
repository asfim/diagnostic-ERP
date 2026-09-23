<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeCollectionPageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'label' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'features' => ['required', 'array', 'size:2'],
            'features.*.title' => ['required', 'string', 'max:100'],
            'features.*.description' => ['required', 'string', 'max:255'],
            'features.*.icon' => ['required', 'string', 'max:60'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'remove_image' => ['nullable', 'boolean'],
        ];
    }
}
