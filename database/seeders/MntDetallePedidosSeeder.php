<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\MntPedidos;
use App\Models\CtlProductos;

class MntDetallePedidosSeeder extends Seeder
{
    public function run()
    {
        // Desactivar restricciones de claves foráneas temporalmente
        Schema::disableForeignKeyConstraints();

        // Vaciar la tabla antes de insertar datos nuevos
        DB::table('_mnt_detalle_pedidos')->truncate();

        // Reactivar restricciones de claves foráneas
        Schema::enableForeignKeyConstraints();

        // Obtener un pedido y un producto aleatorios
        $pedido_id = MntPedidos::inRandomOrder()->first()->id;
        $producto_id = CtlProductos::inRandomOrder()->first()->id;

        // Asegurarse de que existen datos en las tablas
        if (!$pedido_id || !$producto_id) {
            $this->command->info('No se encontraron pedidos o productos disponibles.');
            return;
        }

        // Definir los valores para el detalle de pedido
        $cantidad = rand(1, 5);  // Cantidad aleatoria entre 1 y 5
        $precio = rand(100, 500) / 10;  // Precio aleatorio entre 10.0 y 50.0
        $sub_total = $cantidad * $precio;

        // Insertar un detalle de pedido
        DB::table('_mnt_detalle_pedidos')->insert([
            'pedido_id' => $pedido_id,
            'producto_id' => $producto_id,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'sub_total' => $sub_total,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Se ha insertado un detalle de pedido en _mnt_detalle_pedidos.');
    }
}

