<?php

namespace App\Http\Controllers;

use App\Localizacion;
use Illuminate\Http\Request;

class LocalizacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mapa(){

        $localizaciones = Localizacion::all();
        $ultimaLocalizacion = Localizacion::latest()->first();
        // dd($localizaciones);

        return view('localizacion.mapa')->with(compact('localizaciones', 'ultimaLocalizacion'));
    }

    public function ajaxMapa(){
        $localizaciones = Localizacion::all();
        $ultimaLocalizacion = Localizacion::latest()->first();
        // dd($localizaciones);

        return view('localizacion.ajaxMapa')->with(compact('localizaciones', 'ultimaLocalizacion'));
        
    }
}
