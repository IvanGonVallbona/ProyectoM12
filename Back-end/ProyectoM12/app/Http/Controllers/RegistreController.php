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
        $campanya = Campanya::find($request->campanya_id);
        if ( Auth::user()->tipus_usuari !== 'dm' || $campanya->user_id !== Auth::id() ) 
        {
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
        $campanya = Campanya::find($request->campanya_id);
        if ( Auth::user()->tipus_usuari !== 'dm' || $campanya->user_id !== Auth::id() ) 
        {
            return redirect()->route('registre_list')->with('error', 'No tens permisos per crear registres.');
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

    public function delete(Request $request, $id)
    {
        $registre = Registre::findOrFail($id);
        $campanya = $registre->campanya;

        if (Auth::user()->tipus_usuari !== 'dm' || !$campanya || $campanya->user_id !== Auth::id()) {
            return redirect()->route('registre_list')->with('error', 'No tens permisos per eliminar registres.');
        }

        $titol = $registre->titol;
        $campanya_id = $campanya->id;
        $registre->delete();

        // Redirige según el origen
        if ($request->has('byCampanya') && $request->input('byCampanya')) {
            return redirect()->route('campanya.show', $campanya_id)
                ->with('status', 'Registre "' . $titol . '" eliminat correctament!');
        } else {
            return redirect()->route('registre_list')
                ->with('status', 'Registre "' . $titol . '" eliminat correctament!');
        }
    }

    public function registresByCampanya($campanya_id)
    {
        $registres = Registre::where('campanya_id', $campanya_id)->get();
        return response()->json($registres);
    }

    public function editByCampanya(Request $request, $campanya_id, $registre_id)
    {
        $campanya = Campanya::findOrFail($campanya_id);
        if (Auth::user()->tipus_usuari !== 'dm' || $campanya->user_id !== Auth::id()) {
            return redirect()->route('registre_list')->with('error', 'No tens permisos per editar registres.');
        }

        $registre = Registre::where('campanya_id', $campanya_id)
            ->where('id', $registre_id)
            ->first();

        if (!$registre) {
            return redirect()->route('registre_new_by_campanya', ['campanya_id' => $campanya_id])
                ->with('error', 'No existeix aquest registre per aquesta campanya.');
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'titol' => 'required|string|max:255',
                'descripcio' => 'required|string',
            ]);
            
            $registre->titol = $request->titol;
            $registre->descripcio = $request->descripcio;
            $registre->save();

            return redirect()->route('campanya.show', $campanya_id)
                ->with('status', 'Registre actualitzat!');
        }

        return view('registre.edit', [
            'registre' => $registre,
            'campanya_id' => $campanya_id,
            'byCampanya' => true,
        ]);
    }

    public function newByCampanya(Request $request, $campanya_id)
    {
        $campanya = Campanya::findOrFail($campanya_id);

        if (Auth::user()->tipus_usuari !== 'dm' || $campanya->user_id !== Auth::id()) {
            return redirect()->route('registre_list')->with('error', 'No tens permisos per crear registres.');
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'titol' => 'required|string|max:255',
                'descripcio' => 'required|string',
            ]);

            $registre = new Registre();
            $registre->campanya_id = $campanya_id;
            $registre->titol = $request->titol;
            $registre->descripcio = $request->descripcio;
            $registre->save();

            return redirect()->route('campanya.show', $campanya_id)
                ->with('status', 'Nou registre creat!');
        }

        // Si es GET, mostrar el formulario vacío
        $registre = new Registre();
        return view('registre.edit', [
            'registre' => $registre,
            'campanya_id' => $campanya_id,
            'byCampanya' => true,
        ]);
    }
}
