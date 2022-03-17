<?php

namespace App\Http\Controllers;

use App\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function distritos()
    {
        $distritos = Sector::whereNull('padre_id')
                    ->get();

        return view('sector.distritos')->with(compact('distritos'));
    }

    public function guarda(Request $request)
    {
        // dd($request->all());
        if($request->id != null){
            $distrito = Sector::find($request->id);
        }else{
            $distrito = new Sector();
        }

        $distrito->nombre       = $request->nombre;
        $distrito->departamento = $request->departamento;
        $distrito->save();

        return redirect('Sector/distritos');
    }

    public function elimina(Request $request, $sector_id = null)
    {
        Sector::destroy($sector_id);
        return redirect('Sector/distritos');
    }

    public function otbs(Request $request, $distrito_id)
    {
        // dd($distrito_id);
        $otbs = Sector::where('padre_id', $distrito_id)
                    ->get();

        $distrito = Sector::find($distrito_id);

        return view('sector.otbs')->with(compact('otbs', 'distrito'));
        // dd($distritos);
    }

    public function guardaOtb(Request $request)
    {
        // dd($request->all());
        if($request->id != null){
            $distrito = Sector::find($request->id);
        }else{
            $distrito = new Sector();
        }

        $distrito->padre_id     = $request->padre_id;
        $distrito->nombre       = $request->nombre;
        $distrito->departamento = $request->ciudad;
        $distrito->save();

        return redirect("Sector/otbs/$request->padre_id");
    }

    public function eliminaOtb(Request $request, $otb_id = null)
    {
        $distrito = Sector::find($otb_id);
        Sector::destroy($otb_id);
        return redirect("Sector/otbs/$distrito->padre_id");
    }

}
