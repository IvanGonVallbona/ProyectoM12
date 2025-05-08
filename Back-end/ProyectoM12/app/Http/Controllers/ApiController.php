<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Models\Campanya;
use App\Models\Classe;
use App\Models\Esdeveniment;
use App\Models\Manual;
use App\Models\Personatge;
use App\Models\Raza;
use App\Models\Registre;
use App\Models\User;

class ApiController extends Controller
{
    //MANUALS

    public function listManual()
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

    public function newManual(Request $request)
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

    public function editManual(Request $request, $id)
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

    public function deleteManual($id)
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


    // REGISTRE SESSIONS

    public function listRegistre()
    {
        $registres = Registre::all();
        return view('registre.list', ['registres' => $registres]);
    }

    public function newRegistre(Request $request)
    {
        if (Auth::user()->tipus_usuari !== 'dm') {
            return redirect()->route('registre_list')->with('error', 'No tens permisos per crear registres.');
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'titol' => 'required|string|max:255',
                'descripcio' => 'required|string',
            ]);
            
            $registre = new Registre();
            $registre->titol = $request->titol;
            $registre->descripcio = $request->descripcio;
            $registre->save();
            
            return redirect()->route('registre_list')
                ->with('status', 'Nou registre "' . $registre->titol . '" creat!');
        }
        
        return view('registre.new');
    }

    public function editRegistre(Request $request, $id)
    {
        if (Auth::user()->tipus_usuari !== 'dm') {
            return redirect()->route('registre_list')->with('error', 'No tens permisos per editar registres.');
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

    public function deleteRegistre($id)
    {
        if (Auth::user()->tipus_usuari !== 'dm') {
            return redirect()->route('registre_list')->with('error', 'No tens permisos per eliminar registres.');
        }
        $registre = Registre::findOrFail($id);
        
        $titol = $registre->titol;
        
        $registre->delete();
        
        return redirect()->route('registre_list')
            ->with('status', 'Registre "' . $titol . '" eliminat correctament!');
    }
    

    // CLASSES

    public function listClasses()
    {
        $classes = Classe::with('manual')->get();
        return view('classe.list', compact('classes'));
    }

    public function newClasse(Request $request)
    {
        $manuals = Manual::all();

        if ($request->isMethod('post')) {
            $request->validate([
                'nom' => 'required|string|max:255',
                'descripcio' => 'required|string',
                'joc_id' => 'required|exists:manuals,id',
            ]);

            Classe::create($request->all());
            return redirect()->route('classe_list')->with('status', 'Classe creada correctament.');
        }

        return view('classe.new', compact('manuals'));
    }

    public function editClasse(Request $request, $id)
    {
        $classe = Classe::findOrFail($id);
        $manuals = Manual::all();

        if ($request->isMethod('post')) {
            $request->validate([
                'nom' => 'required|string|max:255',
                'descripcio' => 'required|string',
                'joc_id' => 'required|exists:manuals,id',
            ]);

            $classe->update($request->all());
            return redirect()->route('classe_list')->with('status', 'Classe actualitzada correctament.');
        }

        return view('classe.edit', compact('classe', 'manuals'));
    }

    public function deleteClasse($id)
    {
        $classe = Classe::findOrFail($id);

        $nom = $classe->nom;
        
        $classe->delete();

        return redirect()->route('classe_list')->with('status', 'Classe '.$nom.' eliminada!');
    }

    //RAZAS

    public function indexRaza()
    {
        $razas = Raza::with('manual')->get();
        return view('razas.index', compact('razas'));
    }

    public function createRaza()
    {
        $manuals = Manual::all();
        return view('razas.create', compact('manuals'));
    }

    public function storeRaza(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'joc_id' => 'required|exists:manuals,id',
        ]);

        Raza::create($request->all());
        return redirect()->route('razas.index')->with('success', 'Raza creada correctament.');
    }

    public function editRaza(Raza $raza)
    {
        $manuals = Manual::all();
        return view('razas.edit', compact('raza', 'manuals'));
    }

    public function updateRaza(Request $request, Raza $raza)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'joc_id' => 'required|exists:manuals,id',
        ]);

        $raza->update($request->all());
        return redirect()->route('razas.index')->with('success', 'Raza actualitzada correctament.');
    }

    public function destroyRaza(Raza $raza)
    {
        $raza->delete();
        return redirect()->route('razas.index')->with('success', 'Raza eliminada correctament.');
    }

    // ESDEVENIMENT

    public function __construct(){
        $this->middleware('auth');
    }
    public function indexESDEVENIMENT()
    {
        $esdeveniments = Esdeveniment::all();
        return view('esdeveniments.index', compact('esdeveniments'));
    }

    public function createESDEVENIMENT()
    {
        if (Auth::user()->tipus_usuari !== 'admin' && Auth::user()->tipus_usuari !== 'dm'){
            return redirect()->route('esdeveniments.index')->with('error', 'No tens permisos per crear esdeveniments.');
        }
        return view('esdeveniments.create');
    }

    public function storeESDEVENIMENT(Request $request)
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

    public function showESDEVENIMENT(Esdeveniment $esdeveniment)
    {
        return view('esdeveniments.show', compact('esdeveniment'));
    }

    public function editESDEVENIMENT(Esdeveniment $esdeveniment)
    {
        if (Auth::user()->tipus_usuari === 'dm' && $esdeveniment->user_id !== Auth::id()) {
            return redirect()->route('esdeveniments.index')->with('error', 'No tens permisos per editar aquest esdeveniment.');
        }
    
        if (Auth::user()->tipus_usuari !== 'admin' && Auth::user()->tipus_usuari !== 'dm') {
            return redirect()->route('esdeveniments.index')->with('error', 'No tens permisos per editar esdeveniments.');
        }
        return view('esdeveniments.edit', compact('esdeveniment'));
    }

    public function updateESDEVENIMENT(Request $request, Esdeveniment $esdeveniment)
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

    public function destroyESDEVENIMENT(Esdeveniment $esdeveniment)
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

    // PERSONATGES

    public function indexPersonatge()
    {
        $personatges = Personatge::all();
        return view('personatges.index', compact('personatges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createPersonatge()
    {
        $classes = Classe::all();
        $razas = Raza::all();
        $manuals = \App\Models\Manual::all(); 
        
        return view('personatges.create', [
            'classes' => $classes,
            'razas' => $razas,
            'manuals' => $manuals,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storePersonatge(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'nivell' => 'required|integer|min:1',
            'classe_id' => 'required|exists:classes,id',
            'raza_id' => 'required|exists:razas,id',
            'user_id' => 'required|exists:users,id',
            'campanya_id' => 'nullable|exists:campanyes,id',
            'joc_id' => 'required|exists:manuals,id',
            'imatge' => 'nullable|image|max:2048',
        ]);

        if ($request->file('imatge')) {
            $file = $request->file('imatge');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nom) . '_' . uniqid() . '.' . $extension;

            $rutaImatges = 'uploads/personatges';
            $file->move(public_path($rutaImatges), $filename);

            $validated['imatge'] = $rutaImatges . '/' . $filename;
        }

        Personatge::create($validated);

        return redirect()->route('personatges.index')->with('status', 'Personatge creat correctament!');
    }

    /**
     * Display the specified resource.
     */
    public function showPersonatge(Personatge $personatge)
    {
        return view('personatges.show', compact('personatge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editPersonatge(Personatge $personatge)
    {
        $classes = Classe::all();
        $razas = Raza::all();
        $manuals = \App\Models\Manual::all(); 

        return view('personatges.edit', [
            'classes' => $classes,
            'razas' => $razas,
            'manuals' => $manuals,
            'personatge' => $personatge,
        ]);
    }

    
    
    /**
     * Update the specified resource in storage.
     */
    public function updatePersonatge(Request $request, Personatge $personatge)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'nivell' => 'required|integer|min:1',
            'classe_id' => 'required|exists:classes,id',
            'raza_id' => 'required|exists:razas,id',
            'user_id' => 'required|exists:users,id',
            'joc_id' => 'required|exists:manuals,id',
            'campanya_id' => 'nullable|exists:campanyes,id',
            'imatge' => 'nullable|image|max:2048',
        ]);

        if ($request->file('imatge')) {
            if ($personatge->imatge && file_exists(public_path($personatge->imatge))) {
                unlink(public_path($personatge->imatge));
            }

            $file = $request->file('imatge');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nom) . '_' . uniqid() . '.' . $extension;

            $rutaImatges = 'uploads/personatges';
            $file->move(public_path($rutaImatges), $filename);

            $validated['imatge'] = $rutaImatges . '/' . $filename;
        }

        $personatge->update($validated);

        return redirect()->route('personatges.index')->with('status', 'Personatge actualitzat correctament!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyPersonatge(Personatge $personatge)
    {
        if ($personatge->imatge && file_exists(public_path($personatge->imatge))) {
            unlink(public_path($personatge->imatge));
        }
         $personatge->delete();

        return redirect()->route('personatges.index')->with('status', 'Personatge eliminat correctament!');
    }
}
