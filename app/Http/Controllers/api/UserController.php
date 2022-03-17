<?php

namespace App\Http\Controllers\api;

use App\User;
use App\Localizacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function familiares(Request $request)
    {
        $usuarios           = new User();
        $usuarios->name     = $request->name;
        $usuarios->email    = $request->email;
        $usuarios->password = $request->password;
        $usuarios->perfil   = 'Cliente';
        $usuarios->save();
    }

    public function inicio()
    {
        return response()->json(['mensaje'=>'Hola mundo']);
    }

    public function registra(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
        ]);

        $user           = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $usuarioId = $user->id;

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'usuario' => $usuarioId,
            'nombre' => $request->name,
            'email' => $request->email,
            'token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function login(Request $request)
    {
        /*if(!Auth::attemp($request->only('email', 'password'))){
            return response()->json([
                'message' => "Usuario invalido",
            ], 401);
        }*/

        $user = User::where('email', $request->email)->first(); 

        if (!$user || !Hash::check($request->password, $user->password)) {
            // throw ValidationException::withMessages([
            //     'msg' => ['error.'],
            // ]);
            return response()->json([
                'mensaje' => "error",
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'mensaje'    => 'bueno',
            'usuario'    => $user->id,
            'nombre'     => $user->name,
            'email'      => $user->email,
            'token'      => $token,
            'token_type' => 'Bearer'
        ]);

    }

    public function localizacion(Request $request)
    {
        // se guarda la localizacion
        $localizacion = new Localizacion();
        $localizacion->user_id = $request->user_id;
        $localizacion->latitud = $request->latitud;
        $localizacion->longitud = $request->longitud;
        if($localizacion->save()){
            $estado = 201;
            $mensaje = "Exito";
        }else{
            $estado = 400;
            $mensaje = "Error";
        }

         return response()->json([
            'mensaje' => $mensaje
        ], $estado);
    }
}
