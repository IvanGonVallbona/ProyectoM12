<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manual;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ManualController extends Controller
{
    public function list()
    {
        $manuals = Manual::all();

        foreach ($manuals as $manual) {
            if ($manual->imatge) {
                $manual->imatge = asset('uploads/imatges_manuals/' . $manual->imatge);
            } else {
                $manual->imatge = null;
            }
        }
        return view('manual.list', ['manuals' => $manuals]);
    }

    public function new(Request $request)
    {
        if (Auth::user()->tipus_usuari !== 'admin'){
            return redirect()->route('manual_list')->with('error', 'No tens permisos per crear manuals.');
        }
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
                $file = $request->file('imatge');
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/imatges_manuals'), $filename);
                $manual->imatge = $filename;
            }


            $manual->save();
            
            return redirect()->route('manual_list')
                ->with('status', 'Nou manual "' . $manual->nom . '" creat!');
        }
        
        return view('manual.new');
    }

    public function edit(Request $request, $id)
    {
        if (Auth::user()->tipus_usuari !== 'admin') {
            return redirect()->route('manual_list')->with('error', 'No tens permisos per editar manuals.');
        }
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
                if ($manual->imatge && file_exists(public_path('uploads/imatges_manuals/' . $manual->imatge))) {
                    unlink(public_path('uploads/imatges_manuals/' . $manual->imatge));
                }

                $file = $request->file('imatge');
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/imatges_manuals'), $filename);
                $manual->imatge = $filename;
            }

            $manual->save();
            
            return redirect()->route('manual_list')
                ->with('status', 'Manual "' . $manual->nom . '" actualitzat!');
        }
        
        return view('manual.edit', ['manual' => $manual]);
    }

    public function delete($id)
    {

        if (Auth::user()->tipus_usuari !== 'admin') {
            return redirect()->route('manual_list')->with('error', 'No tens permisos per eliminar manuals.');
        }
        $manual = Manual::findOrFail($id);
        
        $nom = $manual->nom;
        $rutaImatge = public_path('uploads/imatges_manuals/' . $manual->imatge);

        if ($manual->imatge && File::exists($rutaImatge)) {
        File::delete($rutaImatge);
        }
        
        $manual->delete();
        
        return redirect()->route('manual_list')
            ->with('status', 'Manual "' . $nom . '" eliminat correctament!');
    }
}
