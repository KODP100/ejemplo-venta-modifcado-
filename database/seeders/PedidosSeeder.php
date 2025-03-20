<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidosSeeder extends Seeder
{
    public function run()
    {
        DB::table('mnt_pedidos')->insert([
            [
                'fecha_pedido' => now(),
                'estado' => true,
                'total' => 149.99,
                'client_id' => 1, // Asegúrate de que este cliente existe en `mnt_clientes`
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}

