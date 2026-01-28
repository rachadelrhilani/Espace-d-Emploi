<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            // ================= USER =================
            'nom'   => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],

            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'biographie' => ['nullable', 'string', 'max:1000'],
        ];

        // ================= candidat =================
        if ($this->user()->role === 'candidat') {
            $rules = array_merge($rules, [
                'specialite' => ['nullable', 'string', 'max:255'],
                'annees_experience' => ['nullable', 'integer', 'min:0'],
                'competences' => ['nullable', 'string'],
            ]);
        }

        // ================= recruteur =================
        if ($this->user()->role === "recruteur") {
            $rules = array_merge($rules, [
                'nom_entreprise' => ['nullable', 'string', 'max:255'],
                'site_web' => ['nullable', 'url', 'max:255'],
                'localisation' => ['nullable', 'string', 'max:255'],
            ]);
        }

        return $rules;
    }
}
