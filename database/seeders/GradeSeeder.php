<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            [
                'libelle' => 'Stagiaire',
                'salaire_base' => 600.00,
                'description' => 'Stagiaire en formation',
            ],
            [
                'libelle' => 'Junior',
                'salaire_base' => 1800.00,
                'description' => 'Employé débutant (0-2 ans d\'expérience)',
            ],
            [
                'libelle' => 'Confirmé',
                'salaire_base' => 2500.00,
                'description' => 'Employé confirmé (2-5 ans d\'expérience)',
            ],
            [
                'libelle' => 'Senior',
                'salaire_base' => 3500.00,
                'description' => 'Employé senior (5-10 ans d\'expérience)',
            ],
            [
                'libelle' => 'Expert',
                'salaire_base' => 4500.00,
                'description' => 'Expert dans son domaine (10+ ans d\'expérience)',
            ],
            [
                'libelle' => 'Chef d\'équipe',
                'salaire_base' => 3800.00,
                'description' => 'Responsable d\'une équipe',
            ],
            [
                'libelle' => 'Manager',
                'salaire_base' => 5000.00,
                'description' => 'Manager de département',
            ],
            [
                'libelle' => 'Directeur',
                'salaire_base' => 7000.00,
                'description' => 'Directeur de direction',
            ],
            [
                'libelle' => 'Directeur Général',
                'salaire_base' => 10000.00,
                'description' => 'Direction générale de l\'entreprise',
            ],
        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}
