<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UsuariosApp;
use App\Models\DetalleCompras;
use App\Models\Proveedores;

class Compras extends Model
{
    use HasFactory;
    protected $table = 'compras';

    public function responsable() {
        return $this->belongsTo(UsuariosApp::class, 'id_responsable');
    }

    public function proveedor() {
        return $this->belongsTo(Proveedores::class, 'id_provee');
    }

    public function detalle() {
        return $this->hasMany(DetalleCompras::class, 'id_compra');
    }
}
