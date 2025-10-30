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
        Schema::create('employe_formations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_employe')->constrained('employes')->onDelete('cascade');
            $table->foreignId('id_formation')->constrained('formations')->onDelete('cascade');
            $table->enum('statut', ['inscrit', 'present', 'absent', 'certifie'])->default('inscrit');
            $table->decimal('note', 5, 2)->nullable();
            $table->text('commentaire')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employe_formations');
    }
};
