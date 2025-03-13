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
        Schema::create('multas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->foreignId('miembro_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('motivo_id')->nullable()->constrained()->nullOnDelete();
            $table->string('detalles')->nullable();
            $table->float('monto');
            $table->boolean('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multas');
    }
};
