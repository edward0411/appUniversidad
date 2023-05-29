<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compras;

class comprasController extends Controller
{
    public function index()
    {
        $consult = Compras::all();
        return view('compras.index',compact('consult'));
    }

    public function detail($id)
    {
        $consult = Compras::find($id);
        return view('compras.detail',compact('consult'));
    }
}
