<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('resource_id')->constrained()->onDelete('cascade');
            
            // Dates de réservation
            $table->date('date_debut');
            $table->date('date_fin');
            $table->time('heure_debut')->nullable();
            $table->time('heure_fin')->nullable();
            
            // Justification et détails
            $table->text('justification');
            $table->text('description')->nullable();
            
            // Statut de la réservation
            $table->enum('statut', ['pending', 'approved', 'rejected', 'active', 'completed', 'cancelled'])
                  ->default('pending');
            
            // Réponse du gestionnaire
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('response_message')->nullable();
            $table->timestamp('responded_at')->nullable();
            
            // Signalement de problème
            $table->text('incident_report')->nullable();
            $table->timestamp('incident_reported_at')->nullable();
            
            $table->timestamps();
            
            // Index pour améliorer les performances
            $table->index(['resource_id', 'date_debut', 'date_fin']);
            $table->index(['user_id', 'statut']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
