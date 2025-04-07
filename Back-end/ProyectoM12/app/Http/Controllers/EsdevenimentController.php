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
        $esdeveniment->delete();
        return redirect()->route('esdeveniments.index')->with('success', 'Esdeveniment eliminat!');
    }
}
