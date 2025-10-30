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
        Schema::create('evenements', function (Blueprint $table) {
            $table->increments('id_evenement');
            $table->string('titre');
            $table->text('description')->nullable();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->time('heure_debut')->nullable();
            $table->time('heure_fin')->nullable();
            $table->string('lieu')->nullable();
            $table->foreignId('id_type_evenement')->constrained('type_evenements')->onDelete('cascade');
            $table->foreignId('organisateur_id')->constrained('employes', 'id_employe');
            $table->enum('statut', ['planifie', 'en_cours', 'termine', 'annule'])->default('planifie');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};
