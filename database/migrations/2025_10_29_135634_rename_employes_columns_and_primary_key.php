<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Renommer la clé primaire de 'id' à 'id_employe'
        DB::statement('ALTER TABLE employes CHANGE id id_employe INT UNSIGNED AUTO_INCREMENT');

        // Renommer les colonnes de relations
        Schema::table('employes', function (Blueprint $table) {
            $table->renameColumn('direction_id', 'id_direction');
            $table->renameColumn('grade_id', 'id_grade');
            $table->renameColumn('profil_id', 'id_profil_employe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Renommer la clé primaire de 'id_employe' à 'id'
        DB::statement('ALTER TABLE employes CHANGE id_employe id BIGINT UNSIGNED AUTO_INCREMENT');

        // Renommer les colonnes de relations
        Schema::table('employes', function (Blueprint $table) {
            $table->renameColumn('id_direction', 'direction_id');
            $table->renameColumn('id_grade', 'grade_id');
            $table->renameColumn('id_profil_employe', 'profil_id');
        });
    }
};
