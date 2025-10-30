<?php

namespace Database\Seeders;

use App\Models\Direction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $directions = [
            [
                'nom' => 'Direction Générale',
                'description' => 'Direction générale de l\'entreprise',
            ],
            [
                'nom' => 'Direction des Ressources Humaines',
                'description' => 'Gestion du personnel et des ressources humaines',
            ],
            [
                'nom' => 'Direction Financière',
                'description' => 'Gestion financière et comptabilité',
            ],
            [
                'nom' => 'Direction Commerciale',
                'description' => 'Ventes et développement commercial',
            ],
            [
                'nom' => 'Direction Technique',
                'description' => 'Développement et maintenance technique',
            ],
            [
                'nom' => 'Direction Marketing',
                'description' => 'Marketing et communication',
            ],
            [
                'nom' => 'Direction des Opérations',
                'description' => 'Gestion des opérations quotidiennes',
            ],
            [
                'nom' => 'Direction Juridique',
                'description' => 'Affaires juridiques et conformité',
            ],
        ];

        foreach ($directions as $direction) {
            Direction::create($direction);
        }
    }
}
