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
        Schema::create('conges', function (Blueprint $table) {
            $table->increments('id_conge');
            $table->foreignId('id_employe')->constrained('employes')->onDelete('cascade');
            $table->foreignId('id_type_conge')->constrained('type_conges')->onDelete('cascade');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('jours_pris');
            $table->enum('statut', ['en_attente', 'approuve', 'rejete', 'annule'])->default('en_attente');
            $table->text('motif')->nullable();
            $table->text('commentaire')->nullable();
            $table->timestamp('date_demande')->useCurrent();
            $table->timestamp('date_approbation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
