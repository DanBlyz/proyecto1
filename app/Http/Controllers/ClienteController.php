<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function listado(Request $request){
        
        $clientes = Cliente::all();

        return view('cliente.listado')->with(compact('clientes'));

    }

    public function guarda(Request $request){
        // dd($request->all());
        if($request->input('editar-cliente') == 0){
            $cliente =  new Cliente();
        }else{
            $id = $request->input('editar-cliente');
            $cliente = Cliente::find($id);
        }

        $cliente->nombre       = $request->input('nombre');
        $cliente->contacto     = $request->input('contacto');
        $cliente->telefonos    = $request->input('telefonos');
        $cliente->direccion    = $request->input('direccion');

        $cliente->save();

        return redirect('Cliente/listado');
    }

    public function elimina(Request $request, $cliente_id){

        Cliente::destroy($cliente_id);

        return redirect('Cliente/listado');
    }
}
