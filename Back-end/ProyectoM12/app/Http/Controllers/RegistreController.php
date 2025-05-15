<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registre;
use Illuminate\Support\Facades\Auth; 
use App\Models\Campanya;

class RegistreController extends Controller
{

    public function list()
    {
        $registres = Registre::all();
        return view('registre.list', ['registres' => $registres]);
    }

     public function new(Request $request)
    {
        if (Auth::user()->tipus_usuari !== 'dm') {
            return redirect()->route('registre_list')->with('error', 'No tens permisos per crear registres.');
        }

        // Obtener todas las campañas para el desplegable
        $campanyes = Campanya::all();

        if ($request->isMethod('post')) {
            $request->validate([
                'titol' => 'required|string|max:255',
                'descripcio' => 'required|string',
                'campanya_id' => 'required|exists:campanyes,id',
            ]);
            
            $registre = new Registre();
            $registre->titol = $request->titol;
            $registre->descripcio = $request->descripcio;
            $registre->campanya_id = $request->campanya_id; 
            $registre->save();
            
            return redirect()->route('registre_list')
                ->with('status', 'Nou registre "' . $registre->titol . '" creat!');
        }
        
        return view('registre.new', compact('campanyes'));
    }

    public function edit(Request $request, $id)
    {
        if (Auth::user()->tipus_usuari !== 'dm') {
            return redirect()->route('registre_list')->with('error', 'No tens permisos per editar registres.');
        }
        $registre = Registre::findOrFail($id);
        
        if ($request->isMethod('post')) {
            $request->validate([
                'titol' => 'required|string|max:255',
                'descripcio' => 'required|string',
            ]);
            
            $registre->titol = $request->titol;
            $registre->descripcio = $request->descripcio;
            $registre->save();
            
            return redirect()->route('registre_list')
                ->with('status', 'Registre "' . $registre->titol . '" actualitzat!');
        }
        
        return view('registre.edit', ['registre' => $registre]);
    }

    public function delete($id)
    {
        if (Auth::user()->tipus_usuari !== 'dm') {
            return redirect()->route('registre_list')->with('error', 'No tens permisos per eliminar registres.');
        }
        $registre = Registre::findOrFail($id);
        
        $titol = $registre->titol;
        
        $registre->delete();
        
        return redirect()->route('registre_list')
            ->with('status', 'Registre "' . $titol . '" eliminat correctament!');
    }

    public function registresByCampanya($campanya_id)
    {
    $registres = Registre::where('campanya_id', $campanya_id)->get();
    return response()->json($registres);
    }
    
}
