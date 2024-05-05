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
        Schema::create('gares', function (Blueprint $table) {
            $table->id();
            $table->string('localite');
            $table->string('images')->nullable();
            $table->string('nom');
            $table->integer('nombres_train')->nullable();
            $table->boolean('parking')->default(1);
            $table->enum('etat',['Ouverte','Fermé']);
            $table->enum('voie',['voie1','voie2'])->nullable();
            $table->integer('heure_ouverture');
            $table->integer('heure_fermuture');
            $table->unsignedBigInteger('boutiques_id')->nullable();
            $table->foreign('boutiques_id')->references('id')->on('boutiques')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gares');
    }
};
