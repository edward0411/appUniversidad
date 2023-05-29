<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Productos;
use Illuminate\Support\Facades\DB;

class estimacionesController extends Controller
{
    public function compras_index()
    {
        $categorias = Categorias::all();
        return view('estimaciones.compras',compact('categorias'));
    }

    public function getInfoProductos(Request $request)
    {
        $productos = Productos::where('id_categoria',$request->id_categoria)->get();
        return response()->json($productos);
    }

    public function getInfoVetasProducts(Request $request)
    {
        $data = DB::select('call usp_estimacion_compra(?,?,?)',array($request->id_producto,$request->fecha_ini,$request->fecha_fin));
        return response()->json($data);
    }
}
