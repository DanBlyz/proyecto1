<?php

namespace App\Http\Controllers\API;

use App\Dispositivo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DispositivosController extends Controller
{
    public function registra(Request $request)
    {
        $dispositivo = new Dispositivo();
        $dispositivo->user_id = 1;
        $dispositivo->nombre  = $request->nombre;
        $dispositivo->serie   = $request->serie;
            echo $dispositivo->save();

        // return Dispositivo::all();
    }
}
