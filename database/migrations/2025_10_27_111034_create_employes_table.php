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
        Schema::create('employes', function (Blueprint $table) {
            $table->increments('id_employe');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->date('date_naissance')->nullable();
            $table->string('telephone')->nullable();
            $table->string('adresse')->nullable();
            $table->string('poste')->nullable();
            $table->date('date_embauche');
            $table->boolean('disponibilite')->default(true);

            // Remplacer foreignId par unsignedInteger
            $table->unsignedInteger('id_direction');
            $table->foreign('id_direction')->references('id_direction')->on('directions')->onDelete('cascade');

            $table->unsignedInteger('id_grade');
            $table->foreign('id_grade')->references('id_grade')->on('grades')->onDelete('cascade');

            $table->unsignedInteger('id_profil_employe');
            $table->foreign('id_profil_employe')->references('id_profil_employe')->on('profils')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
