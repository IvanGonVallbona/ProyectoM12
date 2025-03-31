<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Classe;

class ClasseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list(){
        $classes = Classe::all();
        return view('classe.list', ['classes' => $classes]);
    }

    public function new(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nom' => 'required|string|max:255',
                'descripcio' => 'required|string'
            ]);
            
            $classe = new Classe;
            $classe->nom = $request->nom;
            $classe->descripcio = $request->descripcio;
            $classe->save();
            
            return redirect()->route('classe_list')->with('status', 'Nova classe '.$classe->nom.' creada!');
        }
        
        return view('classe.new');
    }

    public function edit(Request $request, $id)
    {
        $classe = Classe::findOrFail($id);
        
        if ($request->isMethod('post')) {
            $request->validate([
                'nom' => 'required|string|max:255',
                'descripcio' => 'required|string'
            ]);
            
            $classe->nom = $request->nom;
            $classe->descripcio = $request->descripcio;
            $classe->save();
            
            return redirect()->route('classe_list')->with('status', 'Classe '.$classe->nom.' actualitzada!');
        }
        
        return view('classe.edit', ['classe' => $classe]);
    }

    public function delete($id)
    {
        $classe = Classe::findOrFail($id);
        
        $nom = $classe->nom;
        
        $classe->delete();
        
        return redirect()->route('classe_list')->with('status', 'Classe '.$nom.' eliminada!');
    }

}
