<?php

namespace Database\Seeders;

use App\Models\TypeEvenement;
use Illuminate\Database\Seeder;

class TypeEvenementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typeEvenements = [
            [
                'nom' => 'Réunion d\'équipe',
                'description' => 'Réunion régulière d\'équipe',
            ],
            [
                'nom' => 'Formation',
                'description' => 'Session de formation professionnelle',
            ],
            [
                'nom' => 'Séminaire',
                'description' => 'Séminaire d\'entreprise',
            ],
            [
                'nom' => 'Team Building',
                'description' => 'Activité de cohésion d\'équipe',
            ],
            [
                'nom' => 'Conférence',
                'description' => 'Conférence professionnelle',
            ],
            [
                'nom' => 'Atelier',
                'description' => 'Atelier de travail collaboratif',
            ],
            [
                'nom' => 'Événement social',
                'description' => 'Événement social de l\'entreprise',
            ],
        ];

        foreach ($typeEvenements as $typeEvenement) {
            TypeEvenement::create($typeEvenement);
        }
    }
}
