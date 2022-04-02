<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    private $res_id;

    public function listadoM(Request $request, $res_id){
        $menu = Menu::where('restaurant_id',$res_id)->get();
        return view('categoria.menuP')->with(compact('menu','res_id'));
    }

    public function guardaMenu(Request $request){
        $menu_id = $request->input('menu_id');

        if($menu_id == 0 ){
            $menu = new Menu();
        }else{
            $menu = Menu::find($menu_id);
        }
        $menu->restaurant_id   = $request->input('res_id');
        $menu->tipo            = $request->name;
        $menu->save();

        return redirect('Categoria/menuP');
    }

    public function eliminaMenu(Request $request, $menu_id){

        Menu::destroy($menu_id);
        
        return redirect('Categoria/menuP');
    }

    
}
