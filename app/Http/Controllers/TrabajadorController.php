<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'dni_persona' => 'required',
            'id_rol' => 'required'
        ]);


        $input = $request->all();

        Trabajador::create($input);
        return response()->json([
            'res' => true,
            'message' => "Registro creado correctamente"
        ], status:201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
