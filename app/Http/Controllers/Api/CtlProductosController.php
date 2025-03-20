<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Response\ApiResponse;
use App\Models\CtlInventerio;
use App\Models\CtlProductos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CtlProductosController extends Controller
{
    public function index(Request $request)
{
    try {
        // Obtener los parámetros 'categoria_id' y 'producto_id' de la solicitud
        $categoriaId = $request->input('categoria_id');
        $productoId = $request->input('producto_id');  // Filtro por producto_id
        
        // Construir la consulta para obtener los productos
        $query = CtlProductos::with([
            "categoria" => function ($query) {
                $query->select(['id', 'nombre']); // Seleccionar solo 'id' y 'nombre' de la categoría
            },
            "inventario" // Esto es opcional, si quieres incluir inventario, puedes dejarlo
        ]);

        // Si se pasa el parámetro 'categoria_id', agregar el filtro
        if ($categoriaId) {
            $query->where('categoria_id', $categoriaId);
        }

        // Si se pasa el parámetro 'producto_id', agregar el filtro
        if ($productoId) {
            $query->where('id', $productoId); // Filtro por id del producto
        }

        // Ejecutar la consulta y paginar los resultados
        $products = $query->paginate(10);

        // Devolver los productos en formato JSON
        return response()->json($products);

    } catch (\Exception $e) {
        // En caso de error, devolver el mensaje de error
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
    


    public function store(Request $request)
    {
        try {
            $message = [
                "nombre.required" => "Nombre es requerido",
                "nombre.max" => "Nombre no debe pasar de 255 caracteres",
                "nombre.unique" => "Nombre ya existe",
                "precio.required" => "Precio es requerido",
                "image.required" => "Imagen es requerida",
                "cantidad.required" => "Cantidad es requerida",
                "cantidad.numeric" => "Cantidad debe ser un número"
            ];

            $validators = Validator::make($request->all(), [
                "nombre" => "required|max:255|unique:ctl_productos,nombre",
                "precio" => "required|numeric",
                "image" => "required",
                "cantidad" => "required|numeric"
            ]);

            if ($validators->fails()) {
                return response()->json([
                    'errors' => $validators->errors()
                ], 422);
            }

            DB::beginTransaction();

            // Crear el producto
            $producto = new CtlProductos();
            $producto->fill($request->all());

            if ($producto->save()) {
                // Crear el inventario asociado al producto
                $inventario = new CtlInventerio();
                $inventario->cantidad = $request->cantidad;
                $inventario->product_id = $producto->id;
                DB::commit();

                if ($inventario->save()) {
                    return ApiResponse::success('Se creó el producto', 200, $producto);
                }
            }

        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage());
        }
    }

    public function updateInventario(Request $request, $id)
    {
        try {
            // Buscar el inventario asociado al producto
            $inventario = CtlInventerio::find($id);
            $inventario->cantidad = $inventario->cantidad + $request->cantidad;

            if ($inventario->save()) {
                return ApiResponse::success('Inventario actualizado', 200);
            }
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 422);
        }
    }

    public function deleteProducto($id)
    {
        try {
            // Buscar el producto
            $producto = CtlProductos::find($id);
            $producto->activo = !$producto->activo;

            if ($producto->save()) {
                return ApiResponse::success('Producto actualizado', 200, $producto);
            }
        } catch (\Throwable $th) {
            return ApiResponse::error($th->getMessage(), 500);
        }
    }
}
