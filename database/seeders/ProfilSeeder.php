<?php

namespace Database\Seeders;

use App\Models\Profil;
use Illuminate\Database\Seeder;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profils = [
            [
                'nom' => 'Développeur Full Stack',
                'description' => 'Développement web front-end et back-end',
            ],
            [
                'nom' => 'Développeur Front-End',
                'description' => 'Développement d\'interfaces utilisateur',
            ],
            [
                'nom' => 'Développeur Back-End',
                'description' => 'Développement côté serveur et bases de données',
            ],
            [
                'nom' => 'Chef de Projet',
                'description' => 'Gestion de projets et coordination d\'équipes',
            ],
            [
                'nom' => 'Responsable RH',
                'description' => 'Gestion des ressources humaines',
            ],
            [
                'nom' => 'Comptable',
                'description' => 'Gestion comptable et financière',
            ],
            [
                'nom' => 'Commercial',
                'description' => 'Vente et relation client',
            ],
            [
                'nom' => 'Responsable Marketing',
                'description' => 'Stratégie marketing et communication',
            ],
            [
                'nom' => 'Designer UI/UX',
                'description' => 'Conception d\'interfaces et expérience utilisateur',
            ],
            [
                'nom' => 'Administrateur Système',
                'description' => 'Administration des systèmes et réseaux',
            ],
            [
                'nom' => 'Juriste',
                'description' => 'Conseil juridique et conformité',
            ],
            [
                'nom' => 'Assistant(e) de Direction',
                'description' => 'Support administratif de la direction',
            ],
        ];

        foreach ($profils as $profil) {
            Profil::create($profil);
        }
    }
}
