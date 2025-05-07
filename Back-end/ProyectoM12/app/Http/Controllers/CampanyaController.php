<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campanya;
use Illuminate\Support\Facades\Auth;

class CampanyaController extends Controller
{
    public function list()
    {
        $campanyes = Campanya::with('user')->get();
        return view('campanya.list', ['campanyes' => $campanyes]);
    }

    public function new(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nom' => 'required|string|max:255',
                'descripcio' => 'required|string',
                'estat' => 'required|string|max:100',
                'joc_id' => 'required|exists:manuals,id', 
            ]);
            
            $campanya = new Campanya();
            $campanya->nom = $request->nom;
            $campanya->descripcio = $request->descripcio;
            $campanya->estat = $request->estat;
            $campanya->joc_id = $request->joc_id; 
            $campanya->user_id = Auth::id() ?? $request->user_id;
            $campanya->save();
            
            return redirect()->route('campanya_list')
                ->with('status', 'Nova campanya "' . $campanya->nom . '" creada!');
        }
        
        $manuals = \App\Models\Manual::all(); 
        return view('campanya.new', ['manuals' => $manuals]);
    }

    public function edit(Request $request, $id)
    {
        $campanya = Campanya::findOrFail($id);
        
        if ($request->isMethod('post')) {
            $request->validate([
                'nom' => 'required|string|max:255',
                'descripcio' => 'required|string',
                'estat' => 'required|string|max:100',
                'joc_id' => 'required|exists:manuals,id', 
            ]);
            
            $campanya->nom = $request->nom;
            $campanya->descripcio = $request->descripcio;
            $campanya->estat = $request->estat;
            $campanya->joc_id = $request->joc_id; 
            $campanya->user_id = $request->user_id;
            $campanya->save();
            
            return redirect()->route('campanya_list')
                ->with('status', 'Campanya "' . $campanya->nom . '" actualitzada!');
        }
        
        $manuals = \App\Models\Manual::all(); 
        return view('campanya.edit', ['campanya' => $campanya, 'manuals' => $manuals]);
    }

    public function delete($id)
    {
        $campanya = Campanya::findOrFail($id);
        
        $nom = $campanya->nom;
        
        $campanya->delete();
        
        return redirect()->route('campanya_list')
            ->with('status', 'Campanya "' . $nom . '" eliminada correctament!');
    }
}
