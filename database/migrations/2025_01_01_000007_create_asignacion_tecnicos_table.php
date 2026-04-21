<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asignacion_tecnicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cita_id')->constrained('citas')->cascadeOnDelete();
            $table->foreignId('empleado_id')->constrained('empleados')->cascadeOnDelete();
            $table->timestamp('fecha_asignacion')->useCurrent();
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('asignacion_tecnicos');
    }
};