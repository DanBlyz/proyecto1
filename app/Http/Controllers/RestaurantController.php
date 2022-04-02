<?php
namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function listadoG(Request $request){

        $gerente_id = Auth::user()->id;

        $restaurant = Restaurant::where('gerente_id',$gerente_id)->get();

        return view('categoria.restaurantesG')->with(compact('restaurant'));
    }

    public function guardaRes(Request $request){

        // dd($request->file('archivo'));
        // dd($request->all());

        $res_id = $request->input('restaurant_id');

        if($res_id == 0 ){
            $restaurant = new Restaurant();
        }else{
            $restaurant = Restaurant::find($res_id);
        }
        $restaurant->gerente_id     = Auth::user()->id;
        $restaurant->nombre         = $request->name;
        $restaurant->tipo           = $request->tipo;
        $restaurant->hora_apertura  = $request->hora_apertura;
        $restaurant->hora_cierre    = $request->hora_cierre;
        $restaurant->direccion      = $request->direccion;
        $restaurant->ubicacion      = $request->ubicacion;
        $restaurant->descripcion    = $request->descripcion;
          
        
        if($request->has('archivo'))
        {
            $archivo = $request->file('archivo');
            $direccion = 'img_publicaciones/'; // upload path
            $nombreArchivo = date('YmdHis'). "." . $archivo->getClientOriginalExtension();
            $archivo->move($direccion, $nombreArchivo);

            $restaurant->logotipo = $nombreArchivo;

        }

        $restaurant->save();


        return redirect('Categoria/restaurantesG');
    }

    public function eliminaRes(Request $request, $res_id){

        Restaurant::destroy($res_id);
        
        return redirect('Categoria/restaurantesG');
    }

    // public function listadoM(Request $request, $res_id){
    //     $menu = Menu::where('restaurant_id',$res_id)->get();
    //     return view('categoria.menuP')->with(compact('menu'));
    // }
}
