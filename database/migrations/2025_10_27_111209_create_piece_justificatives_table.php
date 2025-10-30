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
        Schema::create('piece_justificatives', function (Blueprint $table) {
            $table->increments('id_piece');
            $table->foreignId('id_absence')->constrained('absences')->onDelete('cascade');
            $table->string('nom_fichier');
            $table->string('chemin_fichier');
            $table->string('type_fichier');
            $table->integer('taille_fichier');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piece_justificatives');
    }
};
