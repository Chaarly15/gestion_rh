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
        Schema::create('solde_conges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_employe')->constrained('employes')->onDelete('cascade');
            $table->integer('annee');
            $table->integer('jours_acquis');
            $table->integer('jours_pris');
            $table->integer('jours_restants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solde_conges');
    }
};
