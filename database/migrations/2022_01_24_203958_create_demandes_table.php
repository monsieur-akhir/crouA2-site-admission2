<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('num_carte');
            $table->string('nom_etudiant');
            $table->string('prenoms_etudiant');
            $table->string('date_naissance_etudiant');
            $table->string('lieu_naissance_etudiant');
            $table->string('contact_etudiant');
            $table->string('email_etudiant');
            $table->string('handicap_etudiant');
            $table->string('nom_tuteur');
            $table->string('contact_tuteur');
            $table->string('ufr_etudiant');
            $table->string('departement_etudiant');
            $table->string('niveau_actuel_etudiant');
            $table->string('niveau_precedent_etudiant');
            $table->string('decision_final_etudiant');
            $table->string('matricule_crou');
            $table->string('statut');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandes');
    }
}
