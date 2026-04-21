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
        Schema::create('libro_autor', function (Blueprint $table) {
            $table->foreignId('id_libro')->constrained('libros')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_autor')->constrained('autores')->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['id_libro', 'id_autor']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro_autor');
    }
};
