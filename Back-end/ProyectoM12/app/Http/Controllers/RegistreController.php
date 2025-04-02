<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registre;
use Illuminate\Support\Facades\Auth;

class RegistreController extends Controller
{

    public function list()
    {
        $registres = Registre::all();
        return view('registre.list', ['registres' => $registres]);
    }

    public function new(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'titol' => 'required|string|max:255',
                'descripcio' => 'required|string',
            ]);
            
            $registre = new Registre();
            $registre->titol = $request->titol;
            $registre->descripcio = $request->descripcio;
            $registre->save();
            
            return redirect()->route('registre_list')
                ->with('status', 'Nou registre "' . $registre->titol . '" creat!');
        }
        
        return view('registre.new');
    }

    public function edit(Request $request, $id)
    {
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
        $registre = Registre::findOrFail($id);
        
        $titol = $registre->titol;
        
        $registre->delete();
        
        return redirect()->route('registre_list')
            ->with('status', 'Registre "' . $titol . '" eliminat correctament!');
    }
    
}
