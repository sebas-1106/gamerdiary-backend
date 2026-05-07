<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('usuarios');
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('email', 150)->unique();
            $table->string('password', 255);
            $table->enum('rol', ['cliente', 'admin', 'tecnico'])->default('cliente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('usuarios');
        Schema::enableForeignKeyConstraints();
    }
};
