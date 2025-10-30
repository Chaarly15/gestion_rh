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
        // Renommer employe_id en id_employe dans documents
        Schema::table('documents', function (Blueprint $table) {
            $table->renameColumn('employe_id', 'id_employe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Renommer id_employe en employe_id dans documents
        Schema::table('documents', function (Blueprint $table) {
            $table->renameColumn('id_employe', 'employe_id');
        });
    }
};

