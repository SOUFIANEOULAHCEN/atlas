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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('DateReservation');
            $table->boolean('Repas1')->default(false);
            $table->boolean('Repas2')->default(false);
            $table->boolean('Repas3')->default(false);
            $table->boolean('Annulation')->default(false);
            $table->string('Matricule');
            $table->timestamps();

            $table->foreign('Matricule')
                ->references('Matricule')
                ->on('comptes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
