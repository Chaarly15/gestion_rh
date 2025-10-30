<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Créer les permissions pour les Employés
        $employePermissions = [
            'employes.view',
            'employes.view-own',
            'employes.create',
            'employes.update',
            'employes.update-own',
            'employes.delete',
            'employes.export',
        ];

        // Créer les permissions pour les Congés
        $congePermissions = [
            'conges.view',
            'conges.view-own',
            'conges.create',
            'conges.update',
            'conges.update-own',
            'conges.validate',
            'conges.reject',
            'conges.delete',
            'conges.export',
        ];

        // Créer les permissions pour les Absences
        $absencePermissions = [
            'absences.view',
            'absences.view-own',
            'absences.create',
            'absences.update',
            'absences.update-own',
            'absences.validate',
            'absences.delete',
            'absences.export',
        ];

        // Créer les permissions pour les Formations
        $formationPermissions = [
            'formations.view',
            'formations.create',
            'formations.update',
            'formations.delete',
            'formations.enroll',
            'formations.enroll-others',
            'formations.evaluate',
            'formations.export',
        ];

        // Créer les permissions pour les Événements
        $evenementPermissions = [
            'evenements.view',
            'evenements.create',
            'evenements.update',
            'evenements.delete',
            'evenements.participate',
            'evenements.manage-participants',
            'evenements.export',
        ];

        // Créer les permissions pour les Directions
        $directionPermissions = [
            'directions.view',
            'directions.create',
            'directions.update',
            'directions.delete',
            'directions.view-stats',
        ];

        // Créer les permissions pour les Grades
        $gradePermissions = [
            'grades.view',
            'grades.create',
            'grades.update',
            'grades.delete',
        ];

        // Créer les permissions pour les Profils
        $profilPermissions = [
            'profils.view',
            'profils.create',
            'profils.update',
            'profils.delete',
        ];

        // Créer les permissions pour les Types de Congés
        $typeCongePermissions = [
            'type-conges.view',
            'type-conges.create',
            'type-conges.update',
            'type-conges.delete',
        ];

        // Créer les permissions pour les Types d'Événements
        $typeEvenementPermissions = [
            'type-evenements.view',
            'type-evenements.create',
            'type-evenements.update',
            'type-evenements.delete',
        ];

        // Créer les permissions pour les Documents
        $documentPermissions = [
            'documents.view',
            'documents.view-own',
            'documents.upload',
            'documents.download',
            'documents.delete',
            'documents.manage',
        ];

        // Créer les permissions pour les Rapports
        $rapportPermissions = [
            'rapports.view',
            'rapports.view-own',
            'rapports.export-pdf',
            'rapports.export-excel',
            'rapports.dashboard-rh',
            'rapports.dashboard-manager',
        ];

        // Créer les permissions pour les Notifications
        $notificationPermissions = [
            'notifications.view',
            'notifications.send',
            'notifications.manage',
        ];

        // Créer les permissions pour l'Administration
        $adminPermissions = [
            'admin.users.view',
            'admin.users.create',
            'admin.users.update',
            'admin.users.delete',
            'admin.roles.view',
            'admin.roles.assign',
            'admin.audit-logs.view',
            'admin.settings.view',
            'admin.settings.update',
            'admin.backup.create',
        ];

        // Combiner toutes les permissions
        $allPermissions = array_merge(
            $employePermissions,
            $congePermissions,
            $absencePermissions,
            $formationPermissions,
            $evenementPermissions,
            $directionPermissions,
            $gradePermissions,
            $profilPermissions,
            $typeCongePermissions,
            $typeEvenementPermissions,
            $documentPermissions,
            $rapportPermissions,
            $notificationPermissions,
            $adminPermissions
        );

        // Créer toutes les permissions
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Créer les rôles et assigner les permissions

        // 1. RÔLE ADMINISTRATEUR - Accès total
        $adminRole = Role::firstOrCreate(['name' => 'Administrateur', 'guard_name' => 'web']);
        $adminRole->syncPermissions(Permission::all());

        // 2. RÔLE RH - Gestion complète des employés, congés, absences
        $rhRole = Role::firstOrCreate(['name' => 'RH', 'guard_name' => 'web']);
        $rhRole->syncPermissions([
            // Employés - Tous les droits
            ...$employePermissions,
            
            // Congés - Tous les droits
            ...$congePermissions,
            
            // Absences - Tous les droits
            ...$absencePermissions,
            
            // Formations - Tous les droits
            ...$formationPermissions,
            
            // Événements - Tous les droits
            ...$evenementPermissions,
            
            // Directions - Lecture et stats
            'directions.view',
            'directions.view-stats',
            
            // Grades - Tous les droits
            ...$gradePermissions,
            
            // Profils - Tous les droits
            ...$profilPermissions,
            
            // Types de Congés - Tous les droits
            ...$typeCongePermissions,
            
            // Types d'Événements - Tous les droits
            ...$typeEvenementPermissions,
            
            // Documents - Tous les droits
            ...$documentPermissions,
            
            // Rapports - Tous les droits
            ...$rapportPermissions,
            
            // Notifications - Tous les droits
            ...$notificationPermissions,
        ]);

        // 3. RÔLE MANAGER - Validation des congés/absences de son équipe
        $managerRole = Role::firstOrCreate(['name' => 'Manager', 'guard_name' => 'web']);
        $managerRole->syncPermissions([
            // Employés - Lecture de son équipe
            'employes.view',
            'employes.view-own',
            'employes.export',
            
            // Congés - Validation pour son équipe
            'conges.view',
            'conges.view-own',
            'conges.create',
            'conges.update-own',
            'conges.validate',
            'conges.reject',
            'conges.export',
            
            // Absences - Validation pour son équipe
            'absences.view',
            'absences.view-own',
            'absences.create',
            'absences.update-own',
            'absences.validate',
            'absences.export',
            
            // Formations - Inscription de son équipe
            'formations.view',
            'formations.enroll',
            'formations.enroll-others',
            'formations.export',
            
            // Événements - Participation
            'evenements.view',
            'evenements.participate',
            'evenements.manage-participants',
            
            // Directions - Lecture
            'directions.view',
            'directions.view-stats',
            
            // Grades - Lecture
            'grades.view',
            
            // Profils - Lecture
            'profils.view',
            
            // Types de Congés - Lecture
            'type-conges.view',
            
            // Types d'Événements - Lecture
            'type-evenements.view',
            
            // Documents - Lecture de son équipe
            'documents.view',
            'documents.view-own',
            'documents.download',
            
            // Rapports - Dashboard manager
            'rapports.view',
            'rapports.export-pdf',
            'rapports.export-excel',
            'rapports.dashboard-manager',
            
            // Notifications - Lecture
            'notifications.view',
        ]);

        // 4. RÔLE EMPLOYÉ - Accès limité à ses propres données
        $employeRole = Role::firstOrCreate(['name' => 'Employé', 'guard_name' => 'web']);
        $employeRole->syncPermissions([
            // Employés - Ses propres infos
            'employes.view-own',
            'employes.update-own',
            
            // Congés - Ses propres congés
            'conges.view-own',
            'conges.create',
            'conges.update-own',
            
            // Absences - Ses propres absences
            'absences.view-own',
            'absences.create',
            'absences.update-own',
            
            // Formations - Inscription
            'formations.view',
            'formations.enroll',
            
            // Événements - Participation
            'evenements.view',
            'evenements.participate',
            
            // Directions - Lecture
            'directions.view',
            
            // Grades - Lecture
            'grades.view',
            
            // Profils - Lecture
            'profils.view',
            
            // Types de Congés - Lecture
            'type-conges.view',
            
            // Types d'Événements - Lecture
            'type-evenements.view',
            
            // Documents - Ses propres documents
            'documents.view-own',
            'documents.upload',
            'documents.download',
            
            // Rapports - Ses propres rapports
            'rapports.view-own',
            'rapports.export-pdf',
            
            // Notifications - Lecture
            'notifications.view',
        ]);

        // Créer des utilisateurs de test (optionnel)
        $this->createTestUsers($adminRole, $rhRole, $managerRole, $employeRole);

        $this->command->info('Rôles et permissions créés avec succès!');
        $this->command->info('4 rôles créés: Administrateur, RH, Manager, Employé');
        $this->command->info(count($allPermissions) . ' permissions créées');
    }

    /**
     * Créer des utilisateurs de test
     */
    private function createTestUsers($adminRole, $rhRole, $managerRole, $employeRole): void
    {
        // Utilisateur Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gestionrh.com'],
            [
                'name' => 'Administrateur Système',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole($adminRole);

        // Utilisateur RH
        $rh = User::firstOrCreate(
            ['email' => 'rh@gestionrh.com'],
            [
                'name' => 'Responsable RH',
                'password' => bcrypt('password'),
            ]
        );
        $rh->assignRole($rhRole);

        // Utilisateur Manager
        $manager = User::firstOrCreate(
            ['email' => 'manager@gestionrh.com'],
            [
                'name' => 'Manager Équipe',
                'password' => bcrypt('password'),
            ]
        );
        $manager->assignRole($managerRole);

        // Utilisateur Employé
        $employe = User::firstOrCreate(
            ['email' => 'employe@gestionrh.com'],
            [
                'name' => 'Employé Test',
                'password' => bcrypt('password'),
            ]
        );
        $employe->assignRole($employeRole);

        $this->command->info('4 utilisateurs de test créés:');
        $this->command->info('- admin@gestionrh.com (Administrateur)');
        $this->command->info('- rh@gestionrh.com (RH)');
        $this->command->info('- manager@gestionrh.com (Manager)');
        $this->command->info('- employe@gestionrh.com (Employé)');
        $this->command->info('Mot de passe pour tous: password');
    }
}

