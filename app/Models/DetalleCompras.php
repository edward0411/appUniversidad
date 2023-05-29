<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompras extends Model
{
    use HasFactory;
    protected $table = 'detalle_compras';

    public function producto(){
        return $this->belongsTo(Productos::class,'id_producto');
    }
}
