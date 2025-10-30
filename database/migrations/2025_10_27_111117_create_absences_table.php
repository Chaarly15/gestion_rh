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
        Schema::create('absences', function (Blueprint $table) {
            $table->increments('id_absence');
            $table->foreignId('id_employe')->constrained('employes')->onDelete('cascade');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('jours_absence');
            $table->string('motif');
            $table->enum('statut', ['justifiee', 'non_justifiee', 'en_attente'])->default('en_attente');
            $table->text('commentaire')->nullable();
            $table->timestamp('date_declaration')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
