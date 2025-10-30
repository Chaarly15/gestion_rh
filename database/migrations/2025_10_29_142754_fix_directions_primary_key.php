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
        // Renommer la clé primaire de 'id' à 'id_direction'
        DB::statement('ALTER TABLE directions CHANGE id id_direction INT UNSIGNED AUTO_INCREMENT');

        // Changer le type de id_direction dans employes de BIGINT à INT
        Schema::table('employes', function (Blueprint $table) {
            $table->dropForeign('employes_direction_id_foreign');
        });

        DB::statement('ALTER TABLE employes CHANGE id_direction id_direction INT UNSIGNED');

        Schema::table('employes', function (Blueprint $table) {
            $table->foreign('id_direction')
                  ->references('id_direction')
                  ->on('directions')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revenir à 'id'
        Schema::table('employes', function (Blueprint $table) {
            $table->dropForeign(['id_direction']);
        });

        DB::statement('ALTER TABLE employes CHANGE id_direction id_direction BIGINT UNSIGNED');

        Schema::table('employes', function (Blueprint $table) {
            $table->foreign('id_direction')
                  ->references('id')
                  ->on('directions')
                  ->onDelete('cascade');
        });

        DB::statement('ALTER TABLE directions CHANGE id_direction id BIGINT UNSIGNED AUTO_INCREMENT');
    }
};
