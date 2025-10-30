<?php

namespace Database\Seeders;

use App\Models\Employe;
use Illuminate\Database\Seeder;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employes = [
            [
                'matricule' => 'EMP001',
                'nom' => 'DUPONT',
                'prenom' => 'Jean',
                'email' => 'jean.dupont@entreprise.fr',
                'telephone' => '0601020304',
                'poste' => 'Directeur Général',
                'date_naissance' => '1975-05-15',
                'lieu_naissance' => 'Paris',
                'sexe' => 'M',
                'situation_familiale' => 'Marié(e)',
                'nombre_enfants' => 2,
                'adresse' => '123 Avenue des Champs-Élysées',
                'ville' => 'Paris',
                'code_postal' => '75008',
                'pays' => 'France',
                'id_direction' => 1, // Direction Générale
                'id_grade' => 9, // Directeur Général
                'id_profil_employe' => 4, // Chef de Projet
                'date_embauche' => '2010-01-15',
                'type_contrat' => 'CDI',
                'statut' => 'Actif',
                'salaire' => 10000.00,
                'disponibilite' => true,
                'numero_securite_sociale' => '175055012345678',
                'iban' => 'FR7612345678901234567890123',
                'bic' => 'BNPAFRPPXXX',
            ],
            [
                'matricule' => 'EMP002',
                'nom' => 'MARTIN',
                'prenom' => 'Sophie',
                'email' => 'sophie.martin@entreprise.fr',
                'telephone' => '0602030405',
                'poste' => 'Responsable RH',
                'date_naissance' => '1985-08-22',
                'lieu_naissance' => 'Lyon',
                'sexe' => 'F',
                'situation_familiale' => 'Célibataire',
                'nombre_enfants' => 0,
                'adresse' => '45 Rue de la République',
                'ville' => 'Lyon',
                'code_postal' => '69002',
                'pays' => 'France',
                'id_direction' => 2, // Direction RH
                'id_grade' => 7, // Manager
                'id_profil_employe' => 5, // Responsable RH
                'date_embauche' => '2015-03-01',
                'type_contrat' => 'CDI',
                'statut' => 'Actif',
                'salaire' => 4500.00,
                'disponibilite' => true,
                'numero_securite_sociale' => '285088012345679',
                'iban' => 'FR7612345678901234567890124',
                'bic' => 'BNPAFRPPXXX',
            ],
            [
                'matricule' => 'EMP003',
                'nom' => 'BERNARD',
                'prenom' => 'Pierre',
                'email' => 'pierre.bernard@entreprise.fr',
                'telephone' => '0603040506',
                'poste' => 'Développeur Senior',
                'date_naissance' => '1988-11-10',
                'lieu_naissance' => 'Marseille',
                'sexe' => 'M',
                'situation_familiale' => 'Marié(e)',
                'nombre_enfants' => 1,
                'adresse' => '78 Boulevard de la Liberté',
                'ville' => 'Marseille',
                'code_postal' => '13001',
                'pays' => 'France',
                'id_direction' => 5, // Direction Technique
                'id_grade' => 4, // Senior
                'id_profil_employe' => 1, // Développeur Full Stack
                'date_embauche' => '2016-09-15',
                'type_contrat' => 'CDI',
                'statut' => 'Actif',
                'salaire' => 3800.00,
                'disponibilite' => true,
                'numero_securite_sociale' => '188111012345680',
                'iban' => 'FR7612345678901234567890125',
                'bic' => 'BNPAFRPPXXX',
            ],
            [
                'matricule' => 'EMP004',
                'nom' => 'DUBOIS',
                'prenom' => 'Marie',
                'email' => 'marie.dubois@entreprise.fr',
                'telephone' => '0604050607',
                'poste' => 'Designer UI/UX',
                'date_naissance' => '1992-03-25',
                'lieu_naissance' => 'Toulouse',
                'sexe' => 'F',
                'situation_familiale' => 'Célibataire',
                'nombre_enfants' => 0,
                'adresse' => '12 Place du Capitole',
                'ville' => 'Toulouse',
                'code_postal' => '31000',
                'pays' => 'France',
                'id_direction' => 5, // Direction Technique
                'id_grade' => 3, // Confirmé
                'id_profil_employe' => 9, // Designer UI/UX
                'date_embauche' => '2019-06-01',
                'type_contrat' => 'CDI',
                'statut' => 'Actif',
                'salaire' => 2800.00,
                'disponibilite' => true,
                'numero_securite_sociale' => '292033012345681',
                'iban' => 'FR7612345678901234567890126',
                'bic' => 'BNPAFRPPXXX',
            ],
            [
                'matricule' => 'EMP005',
                'nom' => 'LEROY',
                'prenom' => 'Thomas',
                'email' => 'thomas.leroy@entreprise.fr',
                'telephone' => '0605060708',
                'poste' => 'Commercial',
                'date_naissance' => '1990-07-18',
                'lieu_naissance' => 'Nantes',
                'sexe' => 'M',
                'situation_familiale' => 'Marié(e)',
                'nombre_enfants' => 2,
                'adresse' => '56 Cours des 50 Otages',
                'ville' => 'Nantes',
                'code_postal' => '44000',
                'pays' => 'France',
                'id_direction' => 4, // Direction Commerciale
                'id_grade' => 3, // Confirmé
                'id_profil_employe' => 7, // Commercial
                'date_embauche' => '2018-02-15',
                'type_contrat' => 'CDI',
                'statut' => 'Actif',
                'salaire' => 2600.00,
                'disponibilite' => true,
                'numero_securite_sociale' => '190077012345682',
                'iban' => 'FR7612345678901234567890127',
                'bic' => 'BNPAFRPPXXX',
            ],
        ];

        foreach ($employes as $employe) {
            Employe::create($employe);
        }
    }
}
