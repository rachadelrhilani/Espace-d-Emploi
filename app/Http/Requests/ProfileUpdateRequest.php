<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // USER
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],

            // PHOTO (OBLIGATOIRE POUR UPLOAD)
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            // BIO
            'biographie' => ['nullable', 'string', 'max:1000'],

            // CANDIDAT
            'specialite' => ['nullable', 'string', 'max:255'],
            'annees_experience' => ['nullable', 'integer', 'min:0'],
            'competences' => ['nullable', 'string'],
        ];
    }
}
