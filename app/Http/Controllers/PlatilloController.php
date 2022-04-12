<?php

namespace App\Http\Controllers;

use App\Platillo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlatilloController extends Controller
{
    public function listadoP(Request $request, $menu_id){
        $platillo = Platillo::where('menu_id',$menu_id)->get();
        return view('categoria.platillo')->with(compact('platillo', 'menu_id'));
    }
    public function listadoC(Request $request, $menu_id){
        $platillo = Platillo::where('menu_id',$menu_id)->get();
        return view('categoria.platilloC')->with(compact('platillo'));
    }

    public function guardaP(Request $request){

        // dd($request->file('archivo'));
        // dd($request->all());

        $platillo_id = $request->input('platillo_id');

        if($platillo_id == 0 ){
            $platillo = new Platillo();
        }else{
            $platillo = Platillo::find($platillo_id);
        }
        $platillo->menu_id        = $request->input('platillo_id');
        $platillo->nombre         = $request->name;
        $platillo->tipo           = $request->tipo;
        $platillo->ingredientes  = $request->ingredientes;
        $platillo->precio    = $request->precio;
        
        if($request->has('archivo'))
        {
            $archivo = $request->file('archivo');
            $direccion = 'img_publicaciones/'; // upload path
            $nombreArchivo = date('YmdHis'). "." . $archivo->getClientOriginalExtension();
            $archivo->move($direccion, $nombreArchivo);

            $platillo->logotipo = $nombreArchivo;

        }

        $platillo->save();


        return redirect('Categoria/platillo');
    }

    public function eliminaP(Request $request, $platillo_id){

        Platillo::destroy($platillo_id);
        
        return redirect('Categoria/platillo');
    }

}
