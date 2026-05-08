<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('servicios')->delete();

        DB::table('servicios')->insert([
            [
                'nombre_servicio' => 'Setup Basic',
                'descripcion' => 'Instalación básica de espacio gamer. Incluye PC básico, silla, periféricos esenciales, mousepad, luces LED y decoración con posters. Ideal para comenzar tu aventura gamer.',
                'precio' => 799.99,
                'categoria' => 'Basic',
                'imagen_url' => 'https://i.pinimg.com/1200x/78/7c/a5/787ca5505a645bd13bd5c569872be891.jpg',
            ],
            [
                'nombre_servicio' => 'Setup Standard',
                'descripcion' => 'Montaje completo de setup gamer estándar. Incluye PC estándar, silla, teclado, mouse, cascos, parlantes, soporte de cascos, luces LED y decoración. Para el gamer comprometido.',
                'precio' => 1299.99,
                'categoria' => 'Standard',
                'imagen_url' => 'https://i.pinimg.com/1200x/04/c5/ee/04c5ee759b4517483e2edd929853b899.jpg',
            ],
            [
                'nombre_servicio' => 'Setup Premium',
                'descripcion' => 'Setup gamer de alto rendimiento. Incluye PC premium, periféricos premium, silla ergonómica, iluminación LED profesional y decoración completa. Para el gamer exigente.',
                'precio' => 1999.99,
                'categoria' => 'Premium',
                'imagen_url' => 'https://i.pinimg.com/736x/f9/21/fe/f921feb390a9dcb35222dd920ae36301.jpg',
            ],
            [
                'nombre_servicio' => 'Setup Deluxe',
                'descripcion' => 'La experiencia gamer definitiva. Setup completo deluxe con PC de última generación, periféricos top, escritorio gaming, paneles LED, estanterías, decoración premium con figuritas y Funko Pops, micrófono profesional y mucho más.',
                'precio' => 3499.99,
                'categoria' => 'Deluxe',
                'imagen_url' => 'https://i.pinimg.com/1200x/ca/6b/42/ca6b42e1f3128382c0f721fc9facbbd5.jpg',
            ],
        ]);
    }
}
