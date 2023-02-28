<?php

namespace App\Http\Controllers;
use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->has('txtBuscar')){
            $categorias = Persona::where('nombres','like','%'.$request->txtBuscar.'%')->get();
        }
        else{
            $categorias = Persona::all();
        }
        return $categorias;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dni_persona' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'celular' => 'required|unique',
            'direccion' => 'required'
        ]);
        
        $input = $request->all();
        Persona::create($input);
        return response()->json([
            'res' => true,
            'message' => "Registro creado correctamente"
        ], status:201); 
    }

    /**
     * Display the specified resource.
     */
    public function show($dni_persona)
    {
        $persona = Persona::findOrFail($dni_persona);
        return $persona;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $dni_persona)
    {
        $persona = Persona::find($dni_persona);

        if (!$persona) {
            return response()->json([
                'res' => false,
                'message' => "Registro no encontrado"
            ], 404); // Devuelve un error 404 si el registro no se encuentra
        }

        $input = $request->all();
        $persona->update($input);

        return response()->json([
            'res' => true,
            'message' => "Registro actualizado correctamente"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($dni_persona)
    {
        $persona = Persona::find($dni_persona);

        if (!$persona) {
            return response()->json([
                'res' => false,
                'message' => "Registro no encontrado"
            ], 404); // Devuelve un error 404 si el registro no se encuentra
        }

        $persona->delete();

        return response()->json([
            'res' => true,
            'message' => "Registro eliminado correctamente"
        ], 200);
    }
}
