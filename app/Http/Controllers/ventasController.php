<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventas;

class ventasController extends Controller
{
    public function index()
    {
        $consult = Ventas::all();
        return view('ventas.index',compact('consult'));
    }

    public function detail($id)
    {
        $consult = Ventas::find($id);
        return view('ventas.detail',compact('consult'));
    }
}
