<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactPageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'address' => ['required', 'string', 'max:500'],
            'emergency_phone' => ['required', 'string', 'max:40'],
            'appointment_phone' => ['required', 'string', 'max:40'],
            'general_email' => ['required', 'email', 'max:255'],
            'report_email' => ['required', 'email', 'max:255'],
            'map_url' => ['nullable', 'url', 'max:2000'],
            'hours' => ['required', 'array', 'size:4'],
            'hours.*.label' => ['required', 'string', 'max:100'],
            'hours.*.time' => ['required', 'string', 'max:100'],
        ];
    }
}
