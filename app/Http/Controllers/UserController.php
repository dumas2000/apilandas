<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Trabajador;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function registro(Request $request)
    {
        $request->validate([
            'usuario'=> 'required|unique',
            'contraseña'=>'required'
        ]);
        
        $input = $request->all();

        $input['contraseña'] = Hash::make($request->contraseña);
        User::create($input);

        return response()->json([
            'res' => true,
            'message' => "Usuario creado Correctamente"
        ], 201);
        
    }
    

    public function login(Request $request){
        
        $user = User::where('usuario', $request->usuario)->first();

        if ($user && Hash::check($request->contraseña, $user->contraseña)) {
            
            $id_trabajador = $user->id_trabajador;

            $trabajador = Trabajador::where('id_trabajador', $id_trabajador)->first();

            $dni = Trabajador::where('id_trabajador',$id_trabajador)->value('dni_persona');

            $nombres = Persona::where('dni_persona',$dni)->value('nombres');
            $apellidos = Persona::where('dni_persona',$dni)->value('apellidos');

            $id_rol = $trabajador->id_rol;

            $rol = Rol::where('id_rol',$id_rol)->value('nombre_rol');

            $user->api_token = Str::random(100);
            $user->save();

            return response()->json([
                'res' => true,
                'id_trabajador' => $id_trabajador,
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'rol' => $rol,
                'api_token' => $user->api_token,
                'message' => "Bienvenid@"." ".$nombres." ".$apellidos
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => "Usuario o contraseña incorrectos"
            ], 401);
        }
    }

    public function logout($api_token)
    {
        $user = \App\Models\User::where('api_token', $api_token)->first();

        if ($user instanceof User) {
            $user->api_token = null;
            $user->save();
            return response()->json([
                'res' => true,
                'message' => 'Logout exitoso'
            ], 200);
        }else{
            return response()->json([
                'res' => true,
                'message' => 'ERROR'
            ], 404);
        }
        
    }



}
