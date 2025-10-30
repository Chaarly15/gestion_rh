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
        // Fix grades table
        DB::statement('ALTER TABLE grades CHANGE id id_grade INT UNSIGNED AUTO_INCREMENT');

        Schema::table('employes', function (Blueprint $table) {
            $table->dropForeign('employes_grade_id_foreign');
        });

        DB::statement('ALTER TABLE employes CHANGE id_grade id_grade INT UNSIGNED');

        Schema::table('employes', function (Blueprint $table) {
            $table->foreign('id_grade')
                  ->references('id_grade')
                  ->on('grades')
                  ->onDelete('cascade');
        });

        // Fix profils table
        DB::statement('ALTER TABLE profils CHANGE id id_profil_employe INT UNSIGNED AUTO_INCREMENT');

        Schema::table('employes', function (Blueprint $table) {
            $table->dropForeign('employes_profil_id_foreign');
        });

        DB::statement('ALTER TABLE employes CHANGE id_profil_employe id_profil_employe INT UNSIGNED');

        Schema::table('employes', function (Blueprint $table) {
            $table->foreign('id_profil_employe')
                  ->references('id_profil_employe')
                  ->on('profils')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert grades
        Schema::table('employes', function (Blueprint $table) {
            $table->dropForeign(['id_grade']);
        });

        DB::statement('ALTER TABLE employes CHANGE id_grade id_grade BIGINT UNSIGNED');

        Schema::table('employes', function (Blueprint $table) {
            $table->foreign('id_grade')
                  ->references('id')
                  ->on('grades')
                  ->onDelete('cascade');
        });

        DB::statement('ALTER TABLE grades CHANGE id_grade id BIGINT UNSIGNED AUTO_INCREMENT');

        // Revert profils
        Schema::table('employes', function (Blueprint $table) {
            $table->dropForeign(['id_profil_employe']);
        });

        DB::statement('ALTER TABLE employes CHANGE id_profil_employe id_profil_employe BIGINT UNSIGNED');

        Schema::table('employes', function (Blueprint $table) {
            $table->foreign('id_profil_employe')
                  ->references('id')
                  ->on('profils')
                  ->onDelete('cascade');
        });

        DB::statement('ALTER TABLE profils CHANGE id_profil_employe id BIGINT UNSIGNED AUTO_INCREMENT');
    }
};
