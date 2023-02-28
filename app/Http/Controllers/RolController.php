<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('txtBuscar')) {
            $rol = Rol::where('nombre_rol','like','%'.$request->txtBuscar.'%')->get();
        }else{
            $rol = Rol::all();
        }
        return $rol;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'nombre_rol' => 'required'
        ]);
        
        $input = $request -> all();

        Rol::create($input);
        return response()->json([
            'res' => true,
            'message' => "Registro creado correctamente"
        ], status:201); 
    }

    /**
     * Display the specified resource.
     */
    public function show($id_rol)
    {
        $rol = Rol::findOrFail($id_rol);
        return $rol;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_rol)
    {
        $rol = Rol::find($id_rol);

        if (!$rol) {
            return response()->json([
                'res' => false,
                'message' => "Registro no encontrado"
            ], 404); // Devuelve un error 404 si el registro no se encuentra
        }

        $input = $request->all();
        $rol->update($input);

        return response()->json([
            'res' => true,
            'message' => "Registro actualizado correctamente"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_rol)
    {
        $rol = Rol::find($id_rol);

        if (!$rol) {
            return response()->json([
                'res' => false,
                'message' => "Registro no encontrado"
            ], 404); // Devuelve un error 404 si el registro no se encuentra
        }

        $rol->delete();

        return response()->json([
            'res' => true,
            'message' => "Registro eliminado correctamente"
        ], 200);
    }
}
