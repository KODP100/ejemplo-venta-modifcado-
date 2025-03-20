<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CtlInventerio;
use App\Models\CtlProductos; // Asegúrate de importar el modelo de productos
use Faker\Factory as Faker;

class CtlInventarioSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(); // Utilizamos Faker para generar datos aleatorios

        // Crear 10 registros en ctl_inventario
        foreach (range(1, 10) as $index) {
            CtlInventerio::create([
                'product_id' => CtlProductos::inRandomOrder()->first()->id, // Asocia un producto aleatorio
                'cantidad'   => $faker->numberBetween(1, 100), // Cantidad aleatoria entre 1 y 100
            ]);
        }

        // Si no necesitas usar Faker, también puedes hacer lo siguiente:
        // CtlInventerio::create([
        //     'product_id' => 1, // Producto con ID 1
        //     'cantidad' => 50, // Cantidad de 50
        // ]);
    }
}
