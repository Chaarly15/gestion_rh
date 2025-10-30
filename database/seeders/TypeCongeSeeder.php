<?php

namespace Database\Seeders;

use App\Models\TypeConge;
use Illuminate\Database\Seeder;

class TypeCongeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typeConges = [
            [
                'libelle' => 'Congés payés',
                'jours_max' => 25,
                'description' => 'Congés annuels payés',
            ],
            [
                'libelle' => 'Congé maladie',
                'jours_max' => null,
                'description' => 'Arrêt maladie avec justificatif médical',
            ],
            [
                'libelle' => 'Congé maternité',
                'jours_max' => 112,
                'description' => 'Congé maternité légal',
            ],
            [
                'libelle' => 'Congé paternité',
                'jours_max' => 28,
                'description' => 'Congé paternité et d\'accueil de l\'enfant',
            ],
            [
                'libelle' => 'RTT',
                'jours_max' => 12,
                'description' => 'Réduction du temps de travail',
            ],
            [
                'libelle' => 'Congé sans solde',
                'jours_max' => null,
                'description' => 'Congé non rémunéré',
            ],
            [
                'libelle' => 'Congé formation',
                'jours_max' => null,
                'description' => 'Congé pour formation professionnelle',
            ],
            [
                'libelle' => 'Congé exceptionnel',
                'jours_max' => 5,
                'description' => 'Événements familiaux (mariage, décès, etc.)',
            ],
        ];

        foreach ($typeConges as $typeConge) {
            TypeConge::create($typeConge);
        }
    }
}
