<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedores;
use App\Models\Clientes;
use App\Models\UsuariosApp;
use App\Models\Compras;
use App\Models\Ventas;
use Illuminate\Support\Facades\DB;

class reportesController extends Controller
{
    public function view_compras()
    {
        $consult = [];
        $olddata = [];
        $proveedores = Proveedores::all();
        $usuarios = UsuariosApp::all();
        return view('reportes.compras',compact('consult','olddata','proveedores','usuarios'));
    }

    public function search_report_compras(Request $request)
    {
        $fecha_ini = $request->fecha_ini.' 00:00:00';
        $fecha_fin = $request->fecha_fin.' 23:59:59';
        $olddata = $request->all();
        $proveedores = Proveedores::all();
        $usuarios = UsuariosApp::all();
        $consult = Compras::where('fecha_compra','>',$fecha_ini)->where('fecha_compra','<',$fecha_fin);
        if($request->id_proveedor) $consult = $consult->where('id_provee',$request->id_proveedor);
        if($request->id_usuario) $consult = $consult->where('id_responsable',$request->id_usuario);
        $consult = $consult->get();

        return view('reportes.compras',compact('consult','olddata','proveedores','usuarios'));
    }
    
    public function view_ventas()
    {
        $consult = [];
        $olddata = [];
        $clientes = Clientes::all();
        $usuarios = UsuariosApp::all();
        return view('reportes.ventas',compact('consult','olddata','clientes','usuarios'));
    }

    public function search_report_ventas(Request $request)
    {
        $fecha_ini = $request->fecha_ini.' 00:00:00';
        $fecha_fin = $request->fecha_fin.' 23:59:59';
        $olddata = $request->all();
        $clientes = Clientes::all();
        $usuarios = UsuariosApp::all();
        $consult = Ventas::where('created_at','>',$fecha_ini)->where('created_at','<',$fecha_fin);
        if($request->id_cliente) $consult = $consult->where('id_cliente',$request->id_cliente);
        if($request->id_usuario) $consult = $consult->where('id_responsable',$request->id_usuario);
        $consult = $consult->get();
    
        return view('reportes.ventas',compact('consult','olddata','clientes','usuarios'));
    }

    public function inventario()
    {
        $datos = DB::select("SELECT * FROM uv_detalle_saldo_inventario");

        $arrayReportDetalle = [];

        foreach($datos as $key => $item) {
            $arrayReportDetalle[$item->id_producto][$item->movimiento] = $item->cantidad;
            $arrayReportDetalle[$item->id_producto]['nombre'] = $item->nombre;
            $arrayReportDetalle[$item->id_producto]['categoria'] = $item->categoria;
        }

        return view('reportes.inventario',compact('arrayReportDetalle'));
    }
}
