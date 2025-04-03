<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manual;

class ManualController extends Controller
{
    public function list()
    {
        $manuals = Manual::all();
        return view('manual.list', ['manuals' => $manuals]);
    }

    public function new(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nom' => 'required|string|max:255',
                'tipus' => 'required|string|max:100',
                'descripcio' => 'required|string',
                'jugabilidad' => 'required|string',
                'imatge' => 'nullable|image|max:2048', 
            ]);
            
            $manual = new Manual();
            $manual->nom = $request->nom;
            $manual->tipus = $request->tipus;
            $manual->descripcio = $request->descripcio;
            $manual->jugabilidad = $request->jugabilidad;

            if ($request->hasFile('imatge')) {
                $path = $request->file('imatge')->store('manuals', 'public');
                $manual->imatge = $path;
            }

            $manual->save();
            
            return redirect()->route('manual_list')
                ->with('status', 'Nou manual "' . $manual->nom . '" creat!');
        }
        
        return view('manual.new');
    }

    public function edit(Request $request, $id)
    {
        $manual = Manual::findOrFail($id);
        
        if ($request->isMethod('post')) {
            $request->validate([
                'nom' => 'required|string|max:255',
                'tipus' => 'required|string|max:100',
                'descripcio' => 'required|string',
                'jugabilidad' => 'required|string',
                'imatge' => 'nullable|image|max:2048',
            ]);
            
            $manual->nom = $request->nom;
            $manual->tipus = $request->tipus;
            $manual->descripcio = $request->descripcio;
            $manual->jugabilidad = $request->jugabilidad;

            if ($request->hasFile('imatge')) {
                $path = $request->file('imatge')->store('manuals', 'public');
                $manual->imatge = $path;
            }

            $manual->save();
            
            return redirect()->route('manual_list')
                ->with('status', 'Manual "' . $manual->nom . '" actualitzat!');
        }
        
        return view('manual.edit', ['manual' => $manual]);
    }

    public function delete($id)
    {
        $manual = Manual::findOrFail($id);
        
        $nom = $manual->nom;
        
        $manual->delete();
        
        return redirect()->route('manual_list')
            ->with('status', 'Manual "' . $nom . '" eliminat correctament!');
    }
}
