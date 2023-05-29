<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UsuariosApp;
use App\Models\DetalleVentas;
use App\Models\Clientes;

class Ventas extends Model
{
    use HasFactory;
    protected $table = 'ventas';

    public function vendedor() {
        return $this->belongsTo(UsuariosApp::class, 'id_responsable');
    }

    public function cliente() {
        return $this->belongsTo(Clientes::class, 'id_cliente');
    }

    public function detalle() {
        return $this->hasMany(DetalleVentas::class, 'id_venta');
    }
}
