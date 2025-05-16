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
        Schema::create('offres_p_f_es', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_PFERecruteur')->constrained('pferecruteurs')->onDelete('cascade');
            $table->string('sujet');
            $table->string('domaine');
            $table->string('specialite');
            $table->string('lieu');
            $table->integer('duree');
            $table->string('statut_offre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offre_p_f_e_s');
    }
};
