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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->date('date_achat');
            $table->date('date_expiration');
            $table->enum('statut', ['Disponible', 'Expiré', 'Utilisé'])->default('Disponible');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('forfaits_id');
            $table->foreign('forfaits_id')->references('id')->on('forfaits')->onDelete('cascade');
            $table->unsignedBigInteger('gares_depart');
            $table->foreign('gares_depart')->references('id')->on('gares')->onDelete('cascade');
            $table->unsignedBigInteger('gares_arriver');
            $table->foreign('gares_arriver')->references('id')->on('gares')->onDelete('cascade');
            $table->unsignedBigInteger('trajets_id');
            $table->foreign('trajets_id')->references('id')->on('trajets')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
