<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer les rôles et permissions en premier
        $this->call([
            RolePermissionSeeder::class,
        ]);

        // Créer les données de référence
        $this->call([
            DirectionSeeder::class,
            GradeSeeder::class,
            ProfilSeeder::class,
            TypeCongeSeeder::class,
            TypeEvenementSeeder::class,
        ]);

        // Créer les employés de test
        $this->call([
            EmployeSeeder::class,
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
