<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('resources', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('type'); // Serveur, VM...
        $table->string('statut'); // Disponible...
        $table->string('cpu'); 
        $table->string('ram'); 
        $table->string('capacite'); 
        $table->string('os'); 
        $table->string('emplacement'); 
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
        Schema::dropIfExists('resources');
    }
}
