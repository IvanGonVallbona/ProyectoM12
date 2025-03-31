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
            ]);
            
            $campanya = new Campanya();
            $campanya->nom = $request->nom;
            $campanya->descripcio = $request->descripcio;
            $campanya->estat = $request->estat;
            $campanya->user_id = Auth::id() ?? $request->user_id;
            $campanya->save();
            
            return redirect()->route('campanya_list')
                ->with('status', 'Nova campanya "' . $campanya->nom . '" creada!');
        }
        
        return view('campanya.new');
    }

    public function edit(Request $request, $id)
    {
        $campanya = Campanya::findOrFail($id);
        
        if ($request->isMethod('post')) {
            $request->validate([
                'nom' => 'required|string|max:255',
                'descripcio' => 'required|string',
                'estat' => 'required|string|max:100',
            ]);
            
            $campanya->nom = $request->nom;
            $campanya->descripcio = $request->descripcio;
            $campanya->estat = $request->estat;
            $campanya->user_id = $request->user_id;
            $campanya->save();
            
            return redirect()->route('campanya_list')
                ->with('status', 'Campanya "' . $campanya->nom . '" actualitzada!');
        }
        
        return view('campanya.edit', ['campanya' => $campanya]);
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
