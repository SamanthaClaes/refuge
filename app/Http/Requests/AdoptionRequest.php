<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdoptionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'started_at' => ['nullable', 'date'],
            'adopter_id' => ['required'],
            'animal_id' => ['required', 'exists:animals'],
            'closed_at' => ['nullable', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
