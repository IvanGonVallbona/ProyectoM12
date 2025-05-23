<?php

namespace App\Http\Controllers;

use App\Models\Raza;
use App\Models\Manual;
use Illuminate\Http\Request;

class RazaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $manuals = Manual::all();
        [$razas, $joc_id] = $this->filtraPerJoc(Raza::class, $request);
        return view('razas.index', compact('razas', 'manuals', 'joc_id'));
    }

    public function create()
    {
        $manuals = Manual::all();
        return view('razas.create', compact('manuals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'joc_id' => 'required|exists:manuals,id',
        ]);

        Raza::create($request->all());
        return redirect()->route('razas.index')->with('success', 'Raza creada correctament.');
    }

    public function edit(Raza $raza)
    {
        $manuals = Manual::all();
        return view('razas.edit', compact('raza', 'manuals'));
    }

    public function update(Request $request, Raza $raza)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'joc_id' => 'required|exists:manuals,id',
        ]);

        $raza->update($request->all());
        return redirect()->route('razas.index')->with('success', 'Raza actualitzada correctament.');
    }

    public function destroy(Raza $raza)
    {
        $raza->delete();
        return redirect()->route('razas.index')->with( 'success', 'Raza eliminada correctament.');
    }
}
