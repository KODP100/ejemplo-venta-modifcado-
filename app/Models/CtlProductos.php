<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class CtlProductos extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'ctl_productos';
    protected $fillable = [
        'nombre',
        'precio',
        'imagen',
        'categoria_id'
    ];

    // Relación con CtlCategoria (un producto pertenece a una categoría)
    public function categoria(){
        return $this->belongsTo(CtlCategoria::class, 'categoria_id', 'id');
    }

    // Relación con CtlInventerio (un producto tiene un inventario)
    public function inventario(){
        return $this->hasOne(CtlInventerio::class, 'product_id'); // Un producto tiene un inventario
    }

    // Relación con MntDetallePedidos (un producto tiene muchos detalles de pedidos)
    public function detallePedido(){
        return $this->hasMany(MntDetallePedidos::class, 'producto_id', 'id');
    }
}