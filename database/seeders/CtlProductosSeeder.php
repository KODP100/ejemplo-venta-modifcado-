<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CtlProductosSeeder extends Seeder
{
    public function run()
    {
        // Instanciamos Faker para generar datos aleatorios
        $faker = Faker::create();

        // Definimos la cantidad de productos que queremos insertar
        $cantidadProductos = 10;

        for ($i = 0; $i < $cantidadProductos; $i++) {
            // Inserción de productos con categoría aleatoria (id 1 o 2)
            DB::table('ctl_productos')->insert([
                'nombre' => $faker->word(), // Nombre aleatorio
                'precio' => $faker->randomFloat(2, 10, 1000), // Precio aleatorio entre 10 y 1000
                'image' => $faker->imageUrl(), // URL aleatoria de imagen
                'categoria_id' => $faker->randomElement([1, 2]), // Aleatoriamente elige entre categoría 1 y 2
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
