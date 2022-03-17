<?php

namespace App\Http\Controllers;

use App\User;
use App\Sector;
use DataTables;
use App\Familiar;
use App\Encargado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('auth', ['except' => ['verificaUser', 'logout', 'addUser', 'registro', 'validaEmail']]);

    }

    public function verificaUser(Request $request){
        $email = $request->input('email');

        $password = $request->input('contrasenia');

        $user = User::where('email',$email)->first();

        if($user && Hash::check($password,$user->password)){

            $request->session()->put('user', $user);
        }

        // dd($request->session()->get('user'));

        return redirect('/');

    }

    public function addUser(Request $request){

        $user = new User();

        $user->name     = $request->input('nombre');
        $user->email    = $request->input('email');
        $user->perfil   = 'Cliente';
        $user->password = Hash::make($request->input('contrasenia'));

        $user->save();

        $request->session()->put('user', $user);

        return redirect('/');
    }

    public function logout(Request $request){

        $request->session()->flush();

        return redirect('/');
    }

    public function listado()
    {
    	// $usuarios = User::all();
    	// dd($usuarios);
        return view('user.listado');
    }

    public function ajax_listado()
    {
        $usuarios = User::all();
        return Datatables::of($usuarios)
                ->addColumn('action', function($usuarios){
                    return '<a href="#" class="btn btn-icon btn-warning btn-sm mr-2" onclick="edita('.$usuarios->id.')">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-danger btn-sm mr-2" onclick="elimina('.$usuarios->id.', '.$usuarios->name.')">
                                <i class="flaticon2-delete"></i>
                            </a>';
                })->make(true);
    }

    public function nuevo()
    {
        // return view('user.nuevo')->with(compact('usuarios'));        			
        return view('user.nuevo');        			
    }

    public function ajaxDistrito(Request $request)
    {
        $distritos = Sector::where('departamento', $request->departamento)
                        ->whereNull('padre_id')
                        ->get();
        
        return view('user.ajaxDistritos')->with(compact('distritos'));                   
    }

    public function ajaxOtb(Request $request)
    {
        $otbs = Sector::where('padre_id', $request->distrito)
                        ->get();

        return view('user.ajaxOtb')->with(compact('otbs'));                   
    }

    public function guarda(Request $request)
    {
        // dd($request->all());
        $persona                   = new User();
        $persona->sector_id        = $request->sector_id;
        $persona->name             = $request->name;
        $persona->ci               = $request->ci;
        $persona->email            = $request->email;
        $persona->password         = Hash::make($request->password);
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->direccion        = $request->direccion;
        $persona->celulares        = $request->celulares;
        $persona->perfil           = $request->perfil;
        $persona->save();

        return redirect('User/listado');

    }

    public function edita(Request $request, $id)
    {
        $datosUsuario = User::findOrfail($id);
        return view('user.nuevo')->with(compact('datosUsuario'));                   
    }

    public function ajaxlistado(Request $request){
        // dd("En desarroolo :v");
        
        $userEjemplares = User::orderBy('id', 'desc');
                            
        if ($request->filled('nombre')) {
            $nombre = $request->input('nombre');
            $userEjemplares->where('name', 'like', "%$nombre%");
        }

        if ($request->filled('ci')) {
            $ci = $request->input('ci');
            $userEjemplares->where('ci', 'like', "%$ci%");
        }

        if ($request->filled('email')) {
            $email = $request->input('email');
            $userEjemplares->where('email', 'like', "%$email%");
        }

        if ($request->filled('perfil')) {
            $perfil = $request->input('perfil');
            $userEjemplares->where('perfils','like', "%$perfil%");
        }

        if ($request->filled('nombre') || $request->filled('ci') || $request->filled('email') || $request->filled('perfil')) {
            $userEjemplares->limit(300);
        }else{
            $userEjemplares->limit(200);
        }


        $usuarios = $userEjemplares->get();
        
        return view('user.ajaxListado')->with(compact('usuarios'));
    }
    public function listaFamiliar(Request $request, $user_id){

        $user = User::find($user_id);
        
        $parientes = Familiar::where('user_id',$user_id)->get();
        // dd($parientes);

        return view('user.listaFamiliar')->with(compact('parientes','user'));
    }

    public function ajaxBuscaUsuario(Request $request){
        // dd($request->input('ci'));
        // dd("en desaroolo");
        $cedula = $request->input('ci');
        $usuarios = User::where('ci','like',"%$cedula%")->take(5)->get();

        return view('user.ajaxBuscaUsuario')->with(compact('usuarios'));
    }

    public function agregaFamiliar(Request $request){
        // dd($request->all());
        $familiar = new Familiar();

        $familiar->user_id       = $request->input('user_id');
        $familiar->pariente_id   = $request->input('familiar-agregar');
        $familiar->relacion      = $request->input('relacion');

        $familiar->save();

        return redirect("User/listaFamiliar/".$familiar->user_id);
    }

    public function listaSector(Request $request, $user_id){
        // dd("en desarrollo :v");
        
        $user = User::find($user_id);
        
        $encargados = Encargado::where('user_id',$user_id)->get();
        // dd($parientes);

        return view('user.listaSector')->with(compact('encargados','user'));
    }

    public function ajaxBuscaSector(Request $request){
        
        $nombre = $request->input('nombre');
        $sectores = Sector::where('nombre','like',"%$nombre%")
                            ->whereNotNull('padre_id')
                            ->take(5)->get();

        return view('user.ajaxBuscaSector')->with(compact('sectores'));
    }

    public function agregaSector(Request $request){

        $encargado = new Encargado();

        $encargado->user_id       = $request->input('user_id');
        $encargado->sector_id   = $request->input('sector-agregar');

        $encargado->save();

        return redirect("User/listaSector/".$encargado->user_id);
    }

    public function registro()
    {
        return view('user.registro');        			
    }

    public function validaEmail(Request $request)
    {
        $verificaEmail = User::where('email', $request->email)
                            ->count();

        return response()->json(['vEmail'=>$verificaEmail]);
    }

    public function guardaRegistro(Request $request)
    {
        $persona                   = new User();
        $persona->sector_id        = $request->sector_id;
        $persona->name             = $request->name;
        $persona->ci               = $request->ci;
        $persona->email            = $request->email;
        $persona->password         = Hash::make($request->password);
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->direccion        = $request->direccion;
        $persona->celulares        = $request->celulares;
        $persona->perfil           = $request->perfil;
        $persona->save();

        return redirect('User/listado');
    }

}