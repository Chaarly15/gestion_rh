<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeCongeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'libelle' => ['required', 'string', 'max:255'],
            'jours_max' => ['nullable', 'integer', 'min:1', 'max:365'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'libelle.required' => 'Le libellé est obligatoire.',
            'libelle.string' => 'Le libellé doit être une chaîne de caractères.',
            'libelle.max' => 'Le libellé ne peut pas dépasser 255 caractères.',
            'jours_max.integer' => 'Le nombre de jours maximum doit être un nombre entier.',
            'jours_max.min' => 'Le nombre de jours maximum doit être au moins 1.',
            'jours_max.max' => 'Le nombre de jours maximum ne peut pas dépasser 365.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne peut pas dépasser 1000 caractères.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'libelle' => 'libellé',
            'jours_max' => 'nombre de jours maximum',
            'description' => 'description',
        ];
    }
}
