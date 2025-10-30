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
        Schema::create('employe_evenements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_employe')->constrained('employes')->onDelete('cascade');
            $table->foreignId('id_evenement')->constrained('evenements')->onDelete('cascade');
            $table->enum('statut_participation', ['invite', 'confirme', 'present', 'absent'])->default('invite');
            $table->text('commentaire')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employe_evenements');
    }
};
