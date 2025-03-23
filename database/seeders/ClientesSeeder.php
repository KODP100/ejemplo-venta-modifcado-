<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mnt_clientes')->insert([
            [
                'user_id' => 1, // Ajusta el ID según corresponda
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'email' => 'juan.perez@example.com',
                'direccion_envio' => 'Calle Falsa 123, Ciudad',
                'direccion_facturacion' => 'Calle Falsa 123, Ciudad',
                'telefono' => '123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}
