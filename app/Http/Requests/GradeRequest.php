<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GradeRequest extends FormRequest
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
        $gradeId = $this->route('grade') ? $this->route('grade')->id_grade : null;

        return [
            'libelle' => [
                'required',
                'string',
                'max:255',
                Rule::unique('grades', 'libelle')->ignore($gradeId, 'id_grade')
            ],
            'salaire_base' => 'required|numeric|min:0|max:999999.99',
            'description' => 'nullable|string|max:1000',
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
            'libelle.required' => 'Le libellé du grade est obligatoire.',
            'libelle.string' => 'Le libellé doit être une chaîne de caractères.',
            'libelle.max' => 'Le libellé ne peut pas dépasser 255 caractères.',
            'libelle.unique' => 'Ce grade existe déjà.',
            'salaire_base.required' => 'Le salaire de base est obligatoire.',
            'salaire_base.numeric' => 'Le salaire de base doit être un nombre.',
            'salaire_base.min' => 'Le salaire de base ne peut pas être négatif.',
            'salaire_base.max' => 'Le salaire de base est trop élevé.',
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
            'libelle' => 'libellé du grade',
            'salaire_base' => 'salaire de base',
            'description' => 'description',
        ];
    }
}
