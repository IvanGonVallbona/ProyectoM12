<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Manual;

class ClasseController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function list()
    {
        $classes = Classe::with('manual')->get();
        return view('classe.list', compact('classes'));
    }

    public function new(Request $request)
    {
        $manuals = Manual::all();

        if ($request->isMethod('post')) {
            $request->validate([
                'nom' => 'required|string|max:255',
                'descripcio' => 'required|string',
                'joc_id' => 'required|exists:manuals,id',
            ]);

            Classe::create($request->all());
            return redirect()->route('classe_list')->with('status', 'Classe creada correctament.');
        }

        return view('classe.new', compact('manuals'));
    }

    public function edit(Request $request, $id)
    {
        $classe = Classe::findOrFail($id);
        $manuals = Manual::all();

        if ($request->isMethod('post')) {
            $request->validate([
                'nom' => 'required|string|max:255',
                'descripcio' => 'required|string',
                'joc_id' => 'required|exists:manuals,id',
            ]);

            $classe->update($request->all());
            return redirect()->route('classe_list')->with('status', 'Classe actualitzada correctament.');
        }

        return view('classe.edit', compact('classe', 'manuals'));
    }

    public function delete($id)
    {
        $classe = Classe::findOrFail($id);

        $nom = $classe->nom;
        
        $classe->delete();

        return redirect()->route('classe_list')->with('status', 'Classe '.$nom.' eliminada!');
    }
}
