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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->date('jour_debut');
            $table->date('jour_fin');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->string('enseignant');
           // $table->string('ufr');
            //$table->string('filiere');
            //$table->Integer('promotion');
           // $table->string('semestre');
            $table->string('statut')->default('Non valide');
$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
