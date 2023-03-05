<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categorias = Persona::query();
        
        if($request->has('txtBuscar')){
            $categorias->where('nombres','like','%'.$request->txtBuscar.'%');
        }

        $categorias = $categorias->get();

        if ($categorias->isEmpty()) {
            return response()->json([
                'res' => true,
                'message' => "Registro no encontrado"
            ], status:404); 
        }

        return $categorias;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    
        $validator = Validator::make($request->all(), 
                                        $rules = [
                                        'dni_persona' => 'required',
                                        'nombres' => 'required',
                                        'apellidos' => 'required',
                                        'celular' => 'required',
                                        'direccion' => 'required'
                                    ], $messages = [
                                        'dni_persona.required' => 'El campo DNI es requerido.',
                                        'nombres.required' => 'El campo NOMBRES es requerido.',
                                        'apellidos.required' => 'El campo APELLIDOS es requerido.',
                                        'celular.required' => 'El campo CELULAR es requerido.',
                                        'direccion.required' => 'El campo DIRECCIÓN es requerido.'
                                    ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages = [];

            foreach ($errors->messages() as $field => $messages) {
                foreach ($messages as $message) {
                    $errorMessages[$field] = $message;
                }
            }

            return response()->json([
                'message' => [$errorMessages]
            ], 400);
        }

        Persona::create([
            'dni_persona'=> $request->dni_persona,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'celular' => $request->celular,
            'direccion' => $request->direccion,
        ]);
        
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
    public function update(UpdatePersonaRequest $request, $dni_persona)
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
