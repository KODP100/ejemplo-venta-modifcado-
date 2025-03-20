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
            [
                'user_id' => 2,
                'nombre' => 'Ana',
                'apellido' => 'Martínez',
                'email' => 'ana.martinez@example.com',
                'direccion_envio' => 'Calle 20 #30-40, Ciudad',
                'direccion_facturacion' => 'Calle 20 #30-40, Ciudad',
                'telefono' => '234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'nombre' => 'Luis',
                'apellido' => 'Ramírez',
                'email' => 'luis.ramirez@example.com',
                'direccion_envio' => 'Avenida Central 500, Ciudad',
                'direccion_facturacion' => 'Avenida Central 500, Ciudad',
                'telefono' => '345678901',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'nombre' => 'Sofía',
                'apellido' => 'Fernández',
                'email' => 'sofia.fernandez@example.com',
                'direccion_envio' => 'Carrera 15 #100-200, Ciudad',
                'direccion_facturacion' => 'Carrera 15 #100-200, Ciudad',
                'telefono' => '456789012',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'nombre' => 'Pedro',
                'apellido' => 'Gutiérrez',
                'email' => 'pedro.gutierrez@example.com',
                'direccion_envio' => 'Calle Principal 75, Ciudad',
                'direccion_facturacion' => 'Calle Principal 75, Ciudad',
                'telefono' => '567890123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}
