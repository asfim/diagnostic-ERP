<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutPageRequest extends FormRequest
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
            'quote' => ['nullable', 'string', 'max:255'],
            'years_number' => ['required', 'string', 'max:20'],
            'years_text' => ['required', 'string', 'max:100'],
            'button_text' => ['nullable', 'string', 'max:80'],
            'button_link' => ['nullable', 'string', 'max:255'],
            'features' => ['required', 'array', 'size:4'],
            'features.*' => ['nullable', 'string', 'max:120'],
            'mission_title' => ['required', 'string', 'max:100'],
            'mission_text' => ['required', 'string'],
            'vision_title' => ['required', 'string', 'max:100'],
            'vision_text' => ['required', 'string'],
            'values' => ['required', 'array', 'size:4'],
            'values.*.title' => ['required', 'string', 'max:80'],
            'values.*.description' => ['required', 'string', 'max:255'],
            'values.*.icon' => ['required', 'string', 'max:60'],
            'values.*.color' => ['required', 'string', 'max:30'],
            'infrastructure_title' => ['required', 'string', 'max:150'],
            'infrastructure_text' => ['required', 'string'],
            'infrastructure_points' => ['required', 'array', 'size:4'],
            'infrastructure_points.*' => ['required', 'string', 'max:180'],
            'about_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'infrastructure_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'remove_about_image' => ['nullable', 'boolean'],
            'remove_infrastructure_image' => ['nullable', 'boolean'],
        ];
    }
}
