<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PricingPageRequest extends FormRequest
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
            'promo_title' => ['required', 'string', 'max:150'],
            'promo_description' => ['required', 'string'],
            'promo_button_text' => ['required', 'string', 'max:80'],
            'promo_button_link' => ['required', 'string', 'max:255'],
            'promo_icon' => ['required', 'string', 'max:60'],
        ];
    }
}
