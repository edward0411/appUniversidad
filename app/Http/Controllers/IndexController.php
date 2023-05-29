<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsultaValores;

class IndexController extends Controller
{
    
    public function index()
    {
        $consult = ConsultaValores::get();
        return view('index',compact('consult'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
