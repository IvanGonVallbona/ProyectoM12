<?php

namespace App\Http\Controllers;

use App\Models\Personatge;
use App\Models\Classe;
use App\Models\Raza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PersonatgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $personatges = Personatge::all();
        return view('personatges.index', compact('personatges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::all();
        $razas = Raza::all();
        
        return view('personatges.create', [
            'classes' => $classes,
            'razas' => $razas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'nivell' => 'required|integer|min:1',
            'classe_id' => 'required|exists:classes,id',
            'raza_id' => 'required|exists:razas,id',
            'user_id' => 'required|exists:users,id',
            'campanya_id' => 'nullable|exists:campanyes,id',
            'imatge' => 'nullable|image|max:2048',
        ]);

        if ($request->file('imatge')) {
            $file = $request->file('imatge');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nom) . '_' . uniqid() . '.' . $extension;

            // Ruta relativa a la carpeta public
            $rutaImatges = 'uploads/personatges';
            $file->move(public_path($rutaImatges), $filename);

            // Guardar la ruta en la base de datos
            $validated['imatge'] = $rutaImatges . '/' . $filename;
        }

        Personatge::create($validated);

        return redirect()->route('personatges.index')->with('status', 'Personatge creat correctament!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Personatge $personatge)
    {
        return view('personatges.show', compact('personatge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Personatge $personatge)
    {
        $classes = Classe::all();
        $razas = Raza::all();

        return view('personatges.edit', [
            'classes' => $classes,
            'razas' => $razas,
            'personatge' => $personatge,
        ]);
    }

    
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Personatge $personatge)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'nivell' => 'required|integer|min:1',
            'classe_id' => 'required|exists:classes,id',
            'raza_id' => 'required|exists:razas,id',
            'user_id' => 'required|exists:users,id',
            'campanya_id' => 'nullable|exists:campanyes,id',
            'imatge' => 'nullable|image|max:2048',
        ]);

        // Comprovar si hi ha un fitxer introduït
        if ($request->file('imatge')) {
            // Eliminar la imatge anterior si existeix
            if ($personatge->imatge && file_exists(public_path($personatge->imatge))) {
                unlink(public_path($personatge->imatge));
            }

            // Guardar la nova imatge
            $file = $request->file('imatge');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nom) . '_' . uniqid() . '.' . $extension;

            // Ruta relativa a la carpeta public
            $rutaImatges = 'uploads/personatges';
            $file->move(public_path($rutaImatges), $filename);

            // Guardar la ruta en la base de datos
            $validated['imatge'] = $rutaImatges . '/' . $filename;
        }

        // Actualitzar el registre del personatge
        $personatge->update($validated);

        return redirect()->route('personatges.index')->with('status', 'Personatge actualitzat correctament!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personatge $personatge)
    {
        $personatge->delete();

        return redirect()->route('personatges.index')->with('status', 'Personatge eliminat correctament!');
    }

    
    
}
