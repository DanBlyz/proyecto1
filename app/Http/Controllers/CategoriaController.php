<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function listado(Request $request){

        $categorias = Categoria::all();

        return view('categoria.listado')->with(compact('categorias'));
    }

    public function guarda(Request $request){
        // dd($request->all());

        $categoria_id = $request->input('categoria_id');

        if($categoria_id == 0 ){
            $categoria = new Categoria();
        }else{
            $categoria = Categoria::find($categoria_id);
        }

        $categoria->nombre       = $request->input('nombre');
        $categoria->descripcion   = $request->input('descripcion');

        $categoria->save();

        return redirect('Categoria/listado');
    }
    public function elimina(Request $request, $categoria_id){

        Categoria::destroy($categoria_id);
        
        return redirect('Categoria/listado');
    }
}
