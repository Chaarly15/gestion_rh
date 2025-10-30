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
        // Fix type_conges table
        DB::statement('ALTER TABLE type_conges CHANGE id id_type_conge INT UNSIGNED AUTO_INCREMENT');

        // Fix type_evenements table
        DB::statement('ALTER TABLE type_evenements CHANGE id id_type_evenement INT UNSIGNED AUTO_INCREMENT');

        // Fix evenements table
        DB::statement('ALTER TABLE evenements CHANGE id id_evenement INT UNSIGNED AUTO_INCREMENT');

        // Fix conges table - rename primary key and foreign keys
        DB::statement('ALTER TABLE conges CHANGE id id_conge INT UNSIGNED AUTO_INCREMENT');

        Schema::table('conges', function (Blueprint $table) {
            $table->dropForeign('conges_employe_id_foreign');
            $table->dropForeign('conges_type_conge_id_foreign');
        });

        Schema::table('conges', function (Blueprint $table) {
            $table->renameColumn('employe_id', 'id_employe');
            $table->renameColumn('type_conge_id', 'id_type_conge');
        });

        DB::statement('ALTER TABLE conges CHANGE id_employe id_employe INT UNSIGNED');
        DB::statement('ALTER TABLE conges CHANGE id_type_conge id_type_conge INT UNSIGNED');

        Schema::table('conges', function (Blueprint $table) {
            $table->foreign('id_employe')
                  ->references('id_employe')
                  ->on('employes')
                  ->onDelete('cascade');

            $table->foreign('id_type_conge')
                  ->references('id_type_conge')
                  ->on('type_conges')
                  ->onDelete('cascade');
        });

        // Fix absences table
        DB::statement('ALTER TABLE absences CHANGE id id_absence INT UNSIGNED AUTO_INCREMENT');

        // Fix formations table
        DB::statement('ALTER TABLE formations CHANGE id id_formation INT UNSIGNED AUTO_INCREMENT');

        // Fix evenements foreign keys
        Schema::table('evenements', function (Blueprint $table) {
            $table->dropForeign('evenements_type_evenement_id_foreign');
        });

        Schema::table('evenements', function (Blueprint $table) {
            $table->renameColumn('type_evenement_id', 'id_type_evenement');
        });

        DB::statement('ALTER TABLE evenements CHANGE id_type_evenement id_type_evenement INT UNSIGNED');

        Schema::table('evenements', function (Blueprint $table) {
            $table->foreign('id_type_evenement')
                  ->references('id_type_evenement')
                  ->on('type_evenements')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert - simplified for brevity
        DB::statement('ALTER TABLE type_conges CHANGE id_type_conge id BIGINT UNSIGNED AUTO_INCREMENT');
        DB::statement('ALTER TABLE type_evenements CHANGE id_type_evenement id BIGINT UNSIGNED AUTO_INCREMENT');
        DB::statement('ALTER TABLE evenements CHANGE id_evenement id BIGINT UNSIGNED AUTO_INCREMENT');
        DB::statement('ALTER TABLE conges CHANGE id_conge id BIGINT UNSIGNED AUTO_INCREMENT');
        DB::statement('ALTER TABLE absences CHANGE id_absence id BIGINT UNSIGNED AUTO_INCREMENT');
        DB::statement('ALTER TABLE formations CHANGE id_formation id BIGINT UNSIGNED AUTO_INCREMENT');
    }
};
