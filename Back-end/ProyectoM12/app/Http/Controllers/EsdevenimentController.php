<?php

namespace App\Http\Controllers;

use App\Models\Esdeveniment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EsdevenimentController extends Controller
{
    public function index()
    {
        $esdeveniments = Esdeveniment::all();
        return view('esdeveniments.index', compact('esdeveniments'));
    }

    public function create()
    {
        if (Auth::user()->tipus_usuari !== 'admin' && Auth::user()->tipus_usuari !== 'dm'){
            return redirect()->route('esdeveniments.index')->with('error', 'No tens permisos per crear esdeveniments.');
        }
        return view('esdeveniments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'data' => 'required|date',
            'tipus' => 'required|string|max:255',
        ]);

        Esdeveniment::create([
            'nom' => $request->nom,
            'descripcio' => $request->descripcio,
            'data' => $request->data,
            'tipus' => $request->tipus,
            'user_id' => auth()->id(), 
        ]);

        return redirect()->route('esdeveniments.index')->with('status', 'Esdeveniment creat correctament!');
    }

    public function show(Esdeveniment $esdeveniment)
    {
        return view('esdeveniments.show', compact('esdeveniment'));
    }

    public function edit(Esdeveniment $esdeveniment)
    {
        if (Auth::user()->tipus_usuari === 'dm' && $esdeveniment->user_id !== Auth::id()) {
            return redirect()->route('esdeveniments.index')->with('error', 'No tens permisos per editar aquest esdeveniment.');
        }
    
        if (Auth::user()->tipus_usuari !== 'admin' && Auth::user()->tipus_usuari !== 'dm') {
            return redirect()->route('esdeveniments.index')->with('error', 'No tens permisos per editar esdeveniments.');
        }
        return view('esdeveniments.edit', compact('esdeveniment'));
    }

    public function update(Request $request, Esdeveniment $esdeveniment)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'data' => 'required|date',
            'tipus' => 'required|string|max:255',
        ]);

        $esdeveniment->update([
            'nom' => $request->nom,
            'descripcio' => $request->descripcio,
            'data' => $request->data,
            'tipus' => $request->tipus,
        ]);

        return redirect()->route('esdeveniments.index')->with('status', 'Esdeveniment actualitzat correctament!');
    }

    public function destroy(Esdeveniment $esdeveniment)
    {
        if (Auth::user()->tipus_usuari === 'dm' && $esdeveniment->user_id !== Auth::id()) {
            return redirect()->route('esdeveniments.index')->with('error', 'No tens permisos per eliminar aquest esdeveniment.');
        }
    
        if (Auth::user()->tipus_usuari !== 'admin' && Auth::user()->tipus_usuari !== 'dm') {
            return redirect()->route('esdeveniments.index')->with('error', 'No tens permisos per eliminar esdeveniments.');
        }
        $esdeveniment->delete();
        return redirect()->route('esdeveniments.index')->with('success', 'Esdeveniment eliminat!');
    }

    public function inscriureUsuari(Request $request, Esdeveniment $esdeveniment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Inscriure l'usuari només si no està inscrit
        if (!$esdeveniment->participants->contains($request->user_id)) {
            $esdeveniment->participants()->attach($request->user_id);
        }

        return redirect()->route('esdeveniments.index')->with('status', 'Usuari inscrit correctament!');
    }

    public function desinscriureUsuari(Request $request, Esdeveniment $esdeveniment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Desinscriure l'usuari només si està inscrit
        if ($esdeveniment->participants->contains($request->user_id)) {
            $esdeveniment->participants()->detach($request->user_id);
        }

        return redirect()->route('esdeveniments.index')->with('status', 'Usuari desinscrit correctament!');
    }
}