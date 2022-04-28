<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneBonCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_bon_commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produit_id');
            $table->integer('quantite');
            $table->float('prixht');
            $table->foreignId('bon_commande_id');
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
        Schema::dropIfExists('ligne_bon_commandes');
    }
}
