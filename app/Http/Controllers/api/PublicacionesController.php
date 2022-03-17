<?php

namespace App\Http\Controllers\api;

use App\User;
use App\Publicacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicacionesController extends Controller
{
    public function listado()
    {
        $usuarios = User::get();
        // dd($usuarios);
        return response()->json($usuarios);
    }
    
}
