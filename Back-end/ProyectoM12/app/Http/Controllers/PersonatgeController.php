<?php

namespace App\Http\Controllers;

use App\Models\Personatge;
use App\Models\Classe;
use App\Models\Raza;
use App\Models\Manual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Campanya;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Else_;

class PersonatgeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $manuals = Manual::all();
        [$personatges, $joc_id] = $this->filtraPerJoc(Personatge::class, $request);

        return view('personatges.index', compact('personatges', 'manuals', 'joc_id'));
    }

    public function create()
    {
        $manuals = Manual::all();
        $classes = Classe::all();
        $razas = Raza::all();
        $manuals = \App\Models\Manual::all(); 
        
        return view('personatges.create', [
            'jocs' => $manuals,
            'classes' => $classes,
            'razas' => $razas,
            'manuals' => $manuals,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'nivell' => 'required|integer|min:1',
            'classe_id' => 'required|exists:classes,id',
            'raza_id' => 'required|exists:razas,id',
            'joc_id' => 'required|exists:manuals,id',
            'user_id' => 'required|exists:users,id',
            'campanya_id' => 'nullable|exists:campanyes,id',
            'joc_id' => 'required|exists:manuals,id',
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

    public function edit(Personatge $personatge){
       
        if (auth()->user()->tipus_usuari !== 'admin'){
            if ($personatge->campanya) {
                if ($personatge->campanya->user_id !== auth()->id()) {
                    return redirect()->route('personatges.index')->with('error', 'No tens permís per editar aquest personatge.');
                }
            } else {
                // Si no està en campanya, només el propietari pot editar-lo
                if ($personatge->user_id !== auth()->id()) {
                    return redirect()->route('personatges.index')->with('error', 'No tens permís per editar aquest personatge.');
                }
            }
        }


        $manuals = Manual::all();
        $classes = Classe::all();
        $razas = Raza::all();
        $manuals = \App\Models\Manual::all(); 

        return view('personatges.edit', [
            'jocs' => $manuals,
            'classes' => $classes,
            'razas' => $razas,
            'manuals' => $manuals,
            'personatge' => $personatge,
        ]);
    }

    public function update(Request $request, Personatge $personatge)
    {
        if (auth()->user()->tipus_usuari !== 'admin'){
            if ($personatge->campanya) {
                if ($personatge->campanya->user_id !== auth()->id()) {
                    return redirect()->route('personatges.index')->with('error', 'No tens permís per editar aquest personatge.');
                }
            } else {
                // Si no està en campanya, només el propietari pot editar-lo
                if ($personatge->user_id !== auth()->id()) {
                    return redirect()->route('personatges.index')->with('error', 'No tens permís per editar aquest personatge.');
                }
            }
        }


        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'nivell' => 'required|integer|min:1',
            'classe_id' => 'required|exists:classes,id',
            'raza_id' => 'required|exists:razas,id',
            'joc_id' => 'required|exists:manuals,id',
            'user_id' => 'required|exists:users,id',
            'joc_id' => 'required|exists:manuals,id',
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

        return redirect()->route('personatges.index')->with('success', 'Personatge actualitzat correctament!');
    }

    public function destroy(Personatge $personatge)
    {
        if (!auth()->user()->tipus_usuari === 'admin'){
            if ($personatge->campanya) {
                if ($personatge->campanya->user_id !== auth()->id()) {
                    return redirect()->route('personatges.index')->with('error', 'No tens permís per editar aquest personatge.');
                }
            } else {
                // Si no està en campanya, només el propietari pot editar-lo
                if ($personatge->user_id !== auth()->id()) {
                    return redirect()->route('personatges.index')->with('error', 'No tens permís per editar aquest personatge.');
                }
            }
        }

        // Eliminar la imagen asociada si existe
        if ($personatge->imatge && file_exists(public_path($personatge->imatge))) {
            unlink(public_path($personatge->imatge));
        }
        // Eliminar el registre del personatge
        $personatge->delete();

        return redirect()->route('personatges.index')->with('success', 'Personatge eliminat correctament!');
    }
}
