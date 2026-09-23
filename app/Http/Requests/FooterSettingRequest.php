<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FooterSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'description' => ['required', 'string', 'max:500'],
            'cta_title' => ['required', 'string', 'max:150'],
            'cta_description' => ['required', 'string', 'max:500'],
            'cta_button_text' => ['required', 'string', 'max:80'],
            'cta_button_link' => ['required', 'string', 'max:255'],
            'socials' => ['required', 'array', 'size:4'],
            'socials.*.name' => ['required', 'string', 'max:30'],
            'socials.*.icon' => ['required', 'string', 'max:50'],
            'socials.*.url' => ['nullable', 'url', 'max:500'],
            'quick_links' => ['required', 'array', 'size:5'],
            'quick_links.*.label' => ['required', 'string', 'max:60'],
            'quick_links.*.url' => ['required', 'string', 'max:255'],
            'service_links' => ['required', 'array', 'size:5'],
            'service_links.*.label' => ['required', 'string', 'max:60'],
            'service_links.*.url' => ['required', 'string', 'max:255'],
        ];
    }
}
