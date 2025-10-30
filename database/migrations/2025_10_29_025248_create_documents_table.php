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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            // Relation avec l'employé
            $table->foreignId('employe_id')
                  ->constrained('employes')
                  ->onDelete('cascade');

            // Informations du fichier
            $table->string('nom_fichier', 255); // Nom du fichier stocké
            $table->string('nom_original', 255); // Nom original du fichier
            $table->string('type_document', 50); // CV, Contrat, Diplôme, etc.
            $table->integer('taille'); // Taille en bytes
            $table->string('chemin', 500); // Chemin relatif dans storage
            $table->text('description')->nullable(); // Description optionnelle

            // Qui a uploadé le document
            $table->unsignedBigInteger('uploaded_by');
            $table->foreign('uploaded_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();

            // Index pour améliorer les performances
            $table->index('employe_id');
            $table->index('type_document');
            $table->index('uploaded_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
