<?php
namespace App\Http\Controllers;

use App\like;
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

    public function listadoA(Request $request){
        $restaurant = Restaurant::all();
        return view('categoria.restaurantesA')->with(compact('restaurant'));
    }

    public function listadoC(Request $request){
        $restaurant = Restaurant::where('validacion','si')->get();
        return view('social.inicio')->with(compact('restaurant'));
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
        // $restaurant->descripcion    = $request->descripcion;
        $restaurant->validacion    = 'no';
          
        
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

    public function guardaResA(Request $request){

        // dd($request->file('archivo'));
        // dd($request->all());

        $res_id = $request->input('restaurant_id');

        if($res_id == 0 ){
            $restaurant = new Restaurant();
        }else{
            $restaurant = Restaurant::find($res_id);
        }
        $restaurant->nombre         = $request->name;
        $restaurant->tipo           = $request->tipo;
        $restaurant->hora_apertura  = $request->hora_apertura;
        $restaurant->hora_cierre    = $request->hora_cierre;
        $restaurant->direccion      = $request->direccion;
        $restaurant->ubicacion      = $request->ubicacion;
        // $restaurant->descripcion    = $request->descripcion;
        $restaurant->validacion    = $request->validacion;
          
        
        if($request->has('archivo'))
        {
            $archivo = $request->file('archivo');
            $direccion = 'img_publicaciones/'; // upload path
            $nombreArchivo = date('YmdHis'). "." . $archivo->getClientOriginalExtension();
            $archivo->move($direccion, $nombreArchivo);

            $restaurant->logotipo = $nombreArchivo;

        }

        $restaurant->save();


        return redirect('Categoria/restaurantesA');
    }

    public function eliminaRes(Request $request, $res_id){

        Restaurant::destroy($res_id);
        
        return redirect('Categoria/restaurantesG');
    }
    public function modificavalidacion(Request $request, $res_id){

        $restaurant = Restaurant::find($res_id);
        if($restaurant->validacion == 'si'){
            $restaurant->validacion = 'no';
        }else{
            $restaurant->validacion = 'si';
        }
        $restaurant->save();
        
        return redirect('Categoria/restaurantesA');
    }

    public function ajaxListadoRestaurant(Request $request) {

        $nombre = $request->input('busqueda');
        if($nombre == ""){
            $restaurantes = Restaurant::all();
        }else{
            $restaurantes = Restaurant::where('nombre','LIKE', "%$nombre%")
            ->get();
        }


        return view('social.ajaxListadoRestaurant')->with(compact('restaurantes'));
    }

    public function addLike(Request $request) {

        $usuario_id = Auth::user()->id;

        $CanlikeUser = like::where('usuario_id',$usuario_id)
                            ->where('restaurant_id',$request->input('restaurante'))
                            ->count();

        if($CanlikeUser > 0){

            $like = like::where('usuario_id',$usuario_id)
                            ->where('restaurant_id',$request->input('restaurante'))
                            ->first();

            like::destroy($like->id);

        }else{
             $like = new Like();

            $like->usuario_id = Auth::user()->id;
            $like->restaurant_id = $request->input('restaurante');
            $like->like = 1;

            $like->save();

        }

        $CanlikeUser = like::where('restaurant_id',$request->input('restaurante'))
                            ->count();

        return $CanlikeUser;
        
    }
}
