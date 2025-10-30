<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // L'autorisation est gérée par les Policies
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $employeId = $this->route('employe') ? $this->route('employe')->id_employe : null;

        return [
            // Informations personnelles
            'nom' => ['required', 'string', 'max:100'],
            'prenom' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('employes', 'email')->ignore($employeId),
            ],
            'telephone' => ['nullable', 'string', 'max:20'],
            'date_naissance' => ['nullable', 'date', 'before:today'],
            'lieu_naissance' => ['nullable', 'string', 'max:100'],
            'sexe' => ['nullable', Rule::in(['M', 'F'])],
            'situation_familiale' => ['nullable', Rule::in(['Célibataire', 'Marié(e)', 'Divorcé(e)', 'Veuf(ve)'])],
            'nombre_enfants' => ['nullable', 'integer', 'min:0', 'max:20'],
            'adresse' => ['nullable', 'string', 'max:255'],
            'ville' => ['nullable', 'string', 'max:100'],
            'code_postal' => ['nullable', 'string', 'max:10'],
            'pays' => ['nullable', 'string', 'max:100'],
            
            // Informations professionnelles
            'matricule' => [
                'required',
                'string',
                'max:50',
                Rule::unique('employes', 'matricule')->ignore($employeId),
            ],
            'poste' => ['required', 'string', 'max:100'],
            'date_embauche' => ['required', 'date', 'before_or_equal:today'],
            'date_fin_contrat' => ['nullable', 'date', 'after:date_embauche'],
            'type_contrat' => ['required', Rule::in(['CDI', 'CDD', 'Stage', 'Alternance', 'Freelance'])],
            'statut' => ['required', Rule::in(['Actif', 'Inactif', 'En congé', 'Suspendu'])],
            'salaire' => ['nullable', 'numeric', 'min:0'],
            
            // Relations
            'id_direction' => ['required', 'exists:directions,id_direction'],
            'id_grade' => ['required', 'exists:grades,id_grade'],
            'id_profil_employe' => ['required', 'exists:profils,id_profil_employe'],
            
            // Photo
            'photo' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'], // Max 2MB
            
            // Informations bancaires
            'numero_securite_sociale' => ['nullable', 'string', 'max:50'],
            'iban' => ['nullable', 'string', 'max:34'],
            'bic' => ['nullable', 'string', 'max:11'],
            
            // Notes
            'notes' => ['nullable', 'string', 'max:1000'],
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
            'nom' => 'nom',
            'prenom' => 'prénom',
            'email' => 'adresse email',
            'telephone' => 'téléphone',
            'date_naissance' => 'date de naissance',
            'lieu_naissance' => 'lieu de naissance',
            'sexe' => 'sexe',
            'situation_familiale' => 'situation familiale',
            'nombre_enfants' => 'nombre d\'enfants',
            'adresse' => 'adresse',
            'ville' => 'ville',
            'code_postal' => 'code postal',
            'pays' => 'pays',
            'matricule' => 'matricule',
            'poste' => 'poste',
            'date_embauche' => 'date d\'embauche',
            'date_fin_contrat' => 'date de fin de contrat',
            'type_contrat' => 'type de contrat',
            'statut' => 'statut',
            'salaire' => 'salaire',
            'direction_id' => 'direction',
            'grade_id' => 'grade',
            'profil_id' => 'profil',
            'photo' => 'photo',
            'numero_securite_sociale' => 'numéro de sécurité sociale',
            'iban' => 'IBAN',
            'bic' => 'BIC',
            'notes' => 'notes',
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
            'required' => 'Le champ :attribute est obligatoire.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'max' => 'Le champ :attribute ne peut pas dépasser :max caractères.',
            'email' => 'Le champ :attribute doit être une adresse email valide.',
            'unique' => 'Ce :attribute est déjà utilisé.',
            'date' => 'Le champ :attribute doit être une date valide.',
            'before' => 'Le champ :attribute doit être une date antérieure à aujourd\'hui.',
            'before_or_equal' => 'Le champ :attribute doit être une date antérieure ou égale à aujourd\'hui.',
            'after' => 'Le champ :attribute doit être une date postérieure à :date.',
            'in' => 'La valeur sélectionnée pour :attribute est invalide.',
            'integer' => 'Le champ :attribute doit être un nombre entier.',
            'numeric' => 'Le champ :attribute doit être un nombre.',
            'min' => 'Le champ :attribute doit être au minimum :min.',
            'exists' => 'La valeur sélectionnée pour :attribute est invalide.',
            'image' => 'Le fichier :attribute doit être une image.',
            'mimes' => 'Le fichier :attribute doit être de type: :values.',
            'photo.max' => 'La photo ne peut pas dépasser 2 Mo.',
        ];
    }
}

