<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employes', function (Blueprint $table) {
            // Ajouter matricule après id
            $table->string('matricule', 50)->unique()->after('id');

            // Ajouter poste si n'existe pas
            if (!Schema::hasColumn('employes', 'poste')) {
                $table->string('poste')->nullable()->after('email');
            }

            // Informations personnelles supplémentaires
            $table->string('lieu_naissance', 100)->nullable()->after('date_naissance');
            $table->enum('sexe', ['M', 'F'])->nullable()->after('lieu_naissance');
            $table->enum('situation_familiale', ['Célibataire', 'Marié(e)', 'Divorcé(e)', 'Veuf(ve)'])->nullable()->after('sexe');
            $table->integer('nombre_enfants')->default(0)->after('situation_familiale');
            $table->string('ville', 100)->nullable()->after('adresse');
            $table->string('code_postal', 10)->nullable()->after('ville');
            $table->string('pays', 100)->default('France')->after('code_postal');

            // Ajouter disponibilite si n'existe pas
            if (!Schema::hasColumn('employes', 'disponibilite')) {
                $table->boolean('disponibilite')->default(true)->after('pays');
            }

            // Informations professionnelles supplémentaires
            $table->date('date_fin_contrat')->nullable()->after('date_embauche');
            $table->enum('type_contrat', ['CDI', 'CDD', 'Stage', 'Alternance', 'Freelance'])->default('CDI')->after('date_fin_contrat');

            // Modifier statut si existe déjà, sinon créer
            if (Schema::hasColumn('employes', 'statut')) {
                $table->enum('statut', ['Actif', 'Inactif', 'En congé', 'Suspendu'])->default('Actif')->change();
            } else {
                $table->enum('statut', ['Actif', 'Inactif', 'En congé', 'Suspendu'])->default('Actif')->after('type_contrat');
            }

            $table->decimal('salaire', 10, 2)->nullable()->after('statut');

            // Photo
            $table->string('photo', 255)->nullable()->after('salaire');

            // Informations bancaires
            $table->string('numero_securite_sociale', 50)->nullable()->after('photo');
            $table->string('iban', 34)->nullable()->after('numero_securite_sociale');
            $table->string('bic', 11)->nullable()->after('iban');

            // Notes
            $table->text('notes')->nullable()->after('bic');

            // Soft deletes
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employes', function (Blueprint $table) {
            // Supprimer les colonnes ajoutées
            $table->dropColumn([
                'matricule',
                'lieu_naissance',
                'sexe',
                'situation_familiale',
                'nombre_enfants',
                'ville',
                'code_postal',
                'pays',
                'date_fin_contrat',
                'type_contrat',
                'salaire',
                'photo',
                'numero_securite_sociale',
                'iban',
                'bic',
                'notes',
            ]);

            $table->dropSoftDeletes();
        });
    }
};
