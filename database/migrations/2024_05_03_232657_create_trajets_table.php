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
        Schema::create('trajets', function (Blueprint $table) {
            $table->id();
            $table->enum('lieu_depart',['Dakar','Colobane','Dalifort','Maristes','Beaux_maraicheres','Pikine', 'Thiaroye', 'Yembeul', 'Keur_mbaye_fall', 'PNR', 'Rufisque', 'Bargny', 'Diamniadio', 'Sébikhotane', 'Diass'])->default('Dakar');
            $table->enum('lieu_arrive',['Dakar','Colobane','Dalifort','Maristes','Beaux_maraicheres','Pikine', 'Thiaroye', 'Yembeul', 'Keur_mbaye_fall', 'PNR', 'Rufisque', 'Bargny', 'Diamniadio', 'Sébikhotane', 'Diass'])->default('Dakar');
            $table->enum('etat',['Ouvert','Fermé'])->default('Ouvert');
            $table->dateTime('heure_depart');
            $table->dateTime('heure_arrive');
            $table->integer('duree');
            $table->integer('temps_mort');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trajets');
    }
};
