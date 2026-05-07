<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'file' => ['required', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'observations' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
