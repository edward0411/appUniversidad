<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Productos;

class DetalleVentas extends Model
{
    use HasFactory;
    protected $table = 'detalle_ventas';

    public function producto(){
        return $this->belongsTo(Productos::class,'id_producto');
    }
}
