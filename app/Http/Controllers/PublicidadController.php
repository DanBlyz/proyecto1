<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Publicidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicidadController extends Controller
{

    public function guarda(Request $request){

        // dd($request->all());

        if($request->input('publicidad_id') != 0){

            $publicidad_id = $request->input('publicidad_id');
            $publicidad = Publicidad::find($publicidad_id);

        }else{

            $publicidad =  new Publicidad();
            $publicidad->user_id        = Auth::user()->id;
            $publicidad->cliente_id     = $request->input('cliente_id');

        }

        if($request->has('archivo')){
            $fotos = $request->file('archivo');
    
            foreach ($fotos as $key => $value) {
                $archivo = $value;
                $direccion = 'img_publicidad/';
                $nombrearchivo = date('YmdHis').$key.'.'.$value->getClientOriginalExtension();
    
                $archivo->move($direccion,$nombrearchivo);
    
                $publicidad->banner = $nombrearchivo;
            }
        }

        $publicidad->descripcion                = $request->input('descripcion');
        $publicidad->fecha_inicio               = $request->input('fecha_inicio');
        $publicidad->fecha_fin                  = $request->input('fecha_fin');
        $publicidad->cantidad_publicaciones     = $request->input('cantidad_publicaciones');

        $publicidad->save();

        return redirect('Publicidad/listado/'.$publicidad->cliente_id);
    }

    public function listado(Request $request, $cliente_id){
        // dd($cliente_id);
        $publicidades = Publicidad::where('cliente_id',$cliente_id)->get();

        $cliente = Cliente::find($cliente_id);

        return view('publicidad.listado')->with(compact('publicidades','cliente'));
    }

    public function delet(Request $request, $publicidad_id){

        $cliente_id = Publicidad::find($publicidad_id)->cliente_id;

        Publicidad::destroy($publicidad_id);

        return redirect('Publicidad/listado/'.$cliente_id);
    }
}
