<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class AlterTablesSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasColumn('citas', 'updated_at')) {
            Schema::table('citas', function (Blueprint $table) {
                $table->timestamp('updated_at')->nullable();
            });
        }
        if (!Schema::hasColumn('citas', 'created_at')) {
            Schema::table('citas', function (Blueprint $table) {
                $table->timestamp('created_at')->nullable();
            });
        }
        if (!Schema::hasColumn('servicios', 'updated_at')) {
            Schema::table('servicios', function (Blueprint $table) {
                $table->timestamp('updated_at')->nullable();
            });
        }
        if (!Schema::hasColumn('servicios', 'created_at')) {
            Schema::table('servicios', function (Blueprint $table) {
                $table->timestamp('created_at')->nullable();
            });
        }
        if (!Schema::hasColumn('empleados', 'updated_at')) {
            Schema::table('empleados', function (Blueprint $table) {
                $table->timestamp('updated_at')->nullable();
            });
        }
        if (!Schema::hasColumn('usuarios', 'updated_at')) {
            Schema::table('usuarios', function (Blueprint $table) {
                $table->timestamp('updated_at')->nullable();
            });
        }
    }
}
