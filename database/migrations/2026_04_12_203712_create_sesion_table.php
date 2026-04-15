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
        Schema::create('sesion', function (Blueprint $table) {
            $table->id('id_sesion');
            // Llave foránea hacia evento
            $table->foreignId('id_evento')->references('id_evento')->on('evento')->cascadeOnDelete();
            
            $table->date('fecha');
            $table->time('horario');
            $table->string('ponente');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesion');
    }
};
