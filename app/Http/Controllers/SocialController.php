<?php

namespace App\Http\Controllers;

use App\Imagen;
use App\Categoria;
use App\Comentario;
use App\Publicacion;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function inicio()
    {

        $publicaciones = Publicacion::orderBy('id', 'desc')
                                    ->get();

        $categorias = Categoria::all();

        return view('social.inicio')->with(compact('publicaciones','categorias'));

    }

    public function muromobil()
    {
        $publicaciones = Publicacion::orderBy('id', 'desc')
                                    ->get();

        return view('social.muromobil')->with(compact('publicaciones'));
    }

    public function guarda(Request $request){

        // dd($request->session()->get('user')->id);
        // dd($request->all());

        $publicacion               = new Publicacion();
        $publicacion->user_id      = $request->session()->get('user')->id;
        $publicacion->categoria_id = $request->input('categoria_id');
        $publicacion->contenido    = $request->input('publicacion');

        $publicacion->save();

        if($request->has('archivo'))
        {
            $archivo = $request->file('archivo');
            $direccion = 'img_publicaciones/'; // upload path
            $nombreArchivo = date('YmdHis'). "." . $archivo->getClientOriginalExtension();
            $archivo->move($direccion, $nombreArchivo);

            $imagen = new Imagen();
            $imagen->publicacion_id = $publicacion->id;
            $imagen->imagen         = $nombreArchivo;
            $imagen->save();
        }

        // return redirect("Social/muromobil");

        return redirect('/');

    }

    public function ajaxPublicaciones(Request $request){

        $publicaciones = Publicacion::orderBy('id', 'desc')
                                    ->limit(20)
                                    ->get();

        return view('social.ajaxPublicaciones')->with(compact('publicaciones'));
        
    }

    public function addComent(Request $request){        
        // dd($request->input('coment'));
        // dd($request->all());
        $coment =  new Comentario();

        $coment->publicacion_id = $request->input('publicacion_id');
        $coment->user_id        = $request->session()->get('user')->id;
        $coment->comentario     =  $request->input('coment');

        $coment->save();

        $coments = Comentario::where('publicacion_id',$request->input('publicacion_id'))
                            ->limit(3)
                            ->orderBy('id','desc')
                            ->get();

        return view('social.ajaxComent')->with(compact('coments'));

    }

    public function editComent(Request $request){

        $coment = Comentario::find($request->input('coment_id'));

        $coment->comentario = $request->input('coment');

        $coment->save();

        $coments = Comentario::where('publicacion_id',$request->input('publicacion_id'))
                            ->limit(3)
                            ->orderBy('id','desc')
                            ->get();

        return view('social.ajaxComent')->with(compact('coments'));
    }

    public function deleteComent(Request $request){
        // dd($request->all());

        Comentario::destroy($request->input('coment_id'));

        $coments = Comentario::where('publicacion_id',$request->input('publicacion_id'))
                            ->limit(3)
                            ->orderBy('id','desc')
                            ->get();

        return view('social.ajaxComent')->with(compact('coments'));

    }

    public function muestraCategoria(Request $request){
        // dd($request->input('categoria'));
        /*if($request->input('categoria') ==  'todos'){
            $publicaciones = Publicacion::orderBy('id', 'desc')
                                        ->get();
        }elseif($request->input('categoria') ==  'General'){
            $publicaciones = Publicacion::where('categoria_id',1)
                                        ->orderBy('id', 'desc')
                                        ->get();
        }elseif($request->input('categoria') ==  'Desaparecidos'){
            $publicaciones = Publicacion::where('categoria_id',2)
                                        ->orderBy('id', 'desc')
                                        ->get();
        }else{
            $publicaciones = Publicacion::where('Categoria_id',3)
                                        ->orderBy('id', 'desc')
                                        ->get();
        }*/

        $publicaciones = Publicacion::where('categoria_id', $request->input('categoria'))
                                ->orderBy('id', 'desc')
                                ->get();


        $categorias = Categoria::all();

        return view('social.ajaxPublicaciones')->with(compact('publicaciones','categorias'));
    }

    public function eliminaPublicacion(Request $request, $publicacion_id)
    {
        // $publicidadId = Publicacion::find($publicacion_id);
        Publicacion::destroy($publicacion_id);

        return redirect('/');

    }
}
