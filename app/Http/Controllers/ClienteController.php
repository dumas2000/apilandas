<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //GET LISTAR REGISTRO
    public function index(Request $request)
    {
        if ($request->has('txtBuscar')) {
            
            $cliente = Cliente::where('nombres','like','%'.$request->txtBuscar.'%')
                        ->orWhere('dni',$request->txtBuscar)
                        ->orWhere('ruc',$request->txtBuscar)
                        ->get();
        }else{
            $cliente = Cliente::all();
        }

        return $cliente;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);
        return $cliente;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
