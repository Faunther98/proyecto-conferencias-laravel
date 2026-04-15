<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('inscripcion', function (Blueprint $table) {
        $table->id('id_inscripcion');
        

        $table->foreignId('id_evento')->constrained('evento', 'id_evento')->cascadeOnDelete();
        

        $table->foreignId('id_usuario')->constrained('usuario', 'id_usuario')->cascadeOnDelete();
        
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('inscripcion');
    }
};