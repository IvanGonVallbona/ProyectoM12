<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Campanya;
use App\Models\Classe;
use App\Models\Esdeveniment;
use App\Models\Manual;
use App\Models\Personatge;
use App\Models\Raza;
use App\Models\Registre;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    // MANUALS

    public function listManual()
    {
        $manuals = Manual::all();

        foreach ($manuals as $manual) {
            $manual->imatge = $manual->imatge 
                ? asset('uploads/imatges_manuals/' . $manual->imatge) 
                : null;
        }

        return response()->json($manuals);
    }

    public function getManual($id){
        $manual = Manual::find($id);
        return response()->json($manual);
    }

    public function newManual(Request $request)
    {
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

        return response()->json(['message' => 'Manual creat correctament!', 'manual' => $manual], 201);
    }

    public function editManual(Request $request, $id)
    {
        $manual = Manual::findOrFail($id);

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

        return response()->json(['message' => 'Manual actualitzat correctament!', 'manual' => $manual]);
    }

    public function deleteManual($id)
    {
        $manual = Manual::findOrFail($id);

        if ($manual->imatge && File::exists(public_path('uploads/imatges_manuals/' . $manual->imatge))) {
            File::delete(public_path('uploads/imatges_manuals/' . $manual->imatge));
        }

        $manual->delete();

        return response()->json(['message' => 'Manual eliminat correctament!']);
    }

    // REGISTRES

    public function listRegistre()
    {
        $registres = Registre::all();
        return response()->json($registres);
    }

    public function getRegistre($id){
        $registre = Registre::find($id);
        return response()->json($registre);
    }

    public function newRegistre(Request $request)
    {
        $request->validate([
            'titol' => 'required|string|max:255',
            'descripcio' => 'required|string',
        ]);

        $registre = Registre::create($request->all());

        return response()->json(['message' => 'Registre creat correctament!', 'registre' => $registre], 201);
    }

    public function editRegistre(Request $request, $id)
    {
        $registre = Registre::findOrFail($id);

        $request->validate([
            'titol' => 'required|string|max:255',
            'descripcio' => 'required|string',
        ]);

        $registre->update($request->all());

        return response()->json(['message' => 'Registre actualitzat correctament!', 'registre' => $registre]);
    }

    public function deleteRegistre($id)
    {
        $registre = Registre::findOrFail($id);
        $registre->delete();

        return response()->json(['message' => 'Registre eliminat correctament!']);
    }

    // CLASSES

    public function listClasses()
    {
        $classes = Classe::with('manual')->get();
        return response()->json($classes);
    }

    public function getClasse($id){
        $classe = Classe::find($id);
        return response()->json($classe);
    }

    public function newClasse(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'joc_id' => 'required|exists:manuals,id',
        ]);

        $classe = Classe::create($request->all());

        return response()->json(['message' => 'Classe creada correctament!', 'classe' => $classe], 201);
    }

    public function editClasse(Request $request, $id)
    {
        $classe = Classe::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'joc_id' => 'required|exists:manuals,id',
        ]);

        $classe->update($request->all());

        return response()->json(['message' => 'Classe actualitzada correctament!', 'classe' => $classe]);
    }

    public function deleteClasse($id)
    {
        $classe = Classe::findOrFail($id);
        $classe->delete();

        return response()->json(['message' => 'Classe eliminada correctament!']);
    }

    // RAZAS

    public function indexRaza()
    {
        $razas = Raza::with('manual')->get();
        return response()->json($razas);
    }

    public function getRaza($id)
    {
        $raza = Raza::find($id);
        return response()->json($raza);
    }

    public function createRaza(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'joc_id' => 'required|exists:manuals,id',
        ]);

        $raza = Raza::create($request->all());

        return response()->json(['message' => 'Raza creada correctament!', 'raza' => $raza], 201);
    }

    public function editRaza(Request $request, Raza $raza)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'joc_id' => 'required|exists:manuals,id',
        ]);

        $raza->update($request->all());

        return response()->json(['message' => 'Raza actualitzada correctament!', 'raza' => $raza]);
    }

    public function destroyRaza(Raza $raza)
    {
        $raza->delete();

        return response()->json(['message' => 'Raza eliminada correctament!']);
    }

    // ESDEVENIMENTS

    public function indexEsdeveniments()
    {
        $esdeveniments = Esdeveniment::all();
        return response()->json($esdeveniments);
    }

    public function getEsdeveniment($id)
    {
        $esdeveniment = Esdeveniment::find($id);
        return response()->json($esdeveniment);
    }

    public function createEsdeveniment(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'data' => 'required|date',
            'tipus' => 'required|string|max:255',
        ]);

        $esdeveniment = Esdeveniment::create([
            'nom' => $request->nom,
            'descripcio' => $request->descripcio,
            'data' => $request->data,
            'tipus' => $request->tipus,
            'user_id' => auth()->id(),
        ]);

        return response()->json(['message' => 'Esdeveniment creat correctament!', 'esdeveniment' => $esdeveniment], 201);
    }

    public function editEsdeveniment(Request $request, Esdeveniment $esdeveniment)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'data' => 'required|date',
            'tipus' => 'required|string|max:255',
        ]);

        $esdeveniment->update($request->all());

        return response()->json(['message' => 'Esdeveniment actualitzat correctament!', 'esdeveniment' => $esdeveniment]);
    }

    public function destroyEsdeveniment(Esdeveniment $esdeveniment)
    {
        $esdeveniment->delete();

        return response()->json(['message' => 'Esdeveniment eliminat correctament!']);
    }

    public function inscriureUsuari(Request $request, Esdeveniment $esdeveniment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        if (!$esdeveniment->participants->contains($request->user_id)) {
            $esdeveniment->participants()->attach($request->user_id);
        }

        return response()->json(['message' => 'Usuari inscrit correctament!']);
    }

    public function desinscriureUsuari(Request $request, Esdeveniment $esdeveniment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        if ($esdeveniment->participants->contains($request->user_id)) {
            $esdeveniment->participants()->detach($request->user_id);
        }

        return response()->json(['message' => 'Usuari desinscrit correctament!']);
    }

    // PERSONATGES

    public function indexPersonatge()
    {
        $personatges = Personatge::all();
        return response()->json($personatges);
    }

    public function getPersonatge($id)
    {
        $personatge = Personatge::find($id);
        return response()->json($personatge);
    }

    public function createPersonatge(Request $request)
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

        $personatge = Personatge::create($validated);

        return response()->json(['message' => 'Personatge creat correctament!', 'personatge' => $personatge], 201);
    }

    public function editPersonatge(Request $request, Personatge $personatge)
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

        return response()->json(['message' => 'Personatge actualitzat correctament!', 'personatge' => $personatge]);
    }

    public function destroyPersonatge(Personatge $personatge)
    {
        if ($personatge->imatge && file_exists(public_path($personatge->imatge))) {
            unlink(public_path($personatge->imatge));
        }

        $personatge->delete();

        return response()->json(['message' => 'Personatge eliminat correctament!']);
    }


    // CAMPANYES

    public function listCampanyes()
    {
        $campanyes = Campanya::with('user')->get();
        return response()->json($campanyes);
    }

    public function getCampanya($id)
    {
        $campanya = Campanya::findOrFail($id);
        return response()->json($campanya);
    }

    public function createCampanya(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'descripcio' => 'required|string',
        'estat' => 'required|string|max:100',
        'joc_id' => 'required|exists:manuals,id',
        'personatges' => 'required|integer|min:3|max:6',
        'classes' => 'nullable|array',
        'classes.*' => 'nullable|exists:classes,id',
    ]);

    $campanya = new Campanya();
    $campanya->nom = $request->nom;
    $campanya->descripcio = $request->descripcio;
    $campanya->estat = $request->estat;
    $campanya->joc_id = $request->joc_id;
    $campanya->user_id = Auth::id() ?? $request->user_id;
    $campanya->personatges = $request->personatges;
    $campanya->save();

    if ($request->has('classes')) {
        foreach ($request->classes as $classeId) {
            DB::table('classe_campanya')->insert([
                'campanya_id' => $campanya->id,
                'classe_id' => $classeId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    return response()->json(['message' => 'Campanya creada correctament!', 'campanya' => $campanya], 201);
}

public function deleteCampanya($id)
{
    $campanya = Campanya::findOrFail($id);
    $campanya->delete();

    return response()->json(['message' => 'Campanya eliminada correctament!']);
}

public function updateCampanya(Request $request, $id)
{
    $campanya = Campanya::findOrFail($id);

    $request->validate([
        'nom' => 'required|string|max:255',
        'descripcio' => 'required|string',
        'estat' => 'required|string|max:100',
        'joc_id' => 'required|exists:manuals,id',
        'personatges' => 'required|integer|min:3|max:6',
        'classes' => 'nullable|array',
        'classes.*' => 'nullable|exists:classes,id',
    ]);

    $campanya->update($request->only(['nom', 'descripcio', 'estat', 'joc_id', 'personatges']));

    DB::table('classe_campanya')->where('campanya_id', $campanya->id)->delete();

    if ($request->has('classes')) {
        foreach ($request->classes as $classeId) {
            DB::table('classe_campanya')->insert([
                'campanya_id' => $campanya->id,
                'classe_id' => $classeId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    return response()->json(['message' => 'Campanya actualitzada correctament!', 'campanya' => $campanya]);
}

public function addPersonatgeToCampanyaApi($id_campanya, $id_personatge)
{
    $personatge = DB::table('personatges')->where('id', $id_personatge)->first();
    if (!$personatge) {
        return response()->json(['error' => 'Personatge no trobat.'], 404);
    }

    if ($personatge->campanya_id) {
        return response()->json(['error' => 'El personatge ja està assignat a una altra campanya.'], 400);
    }

    $campanya = Campanya::findOrFail($id_campanya);
    if (!$campanya) {
        return response()->json(['error' => 'Campanya no trobada.'], 404);
    }

    $personatgesCount = DB::table('personatges')
        ->where('campanya_id', $id_campanya)
        ->count();
    if ($personatgesCount >= $campanya->personatges) {
        return response()->json(['error' => 'No es poden afegir més personatges a aquesta campanya.'], 400);
    }

    if ($personatge->joc_id !== $campanya->joc_id) {
        return response()->json(['error' => 'El personatge no pertany al mateix joc que la campanya.'], 400);
    }

    DB::table('personatges')
        ->where('id', $id_personatge)
        ->update(['campanya_id' => $id_campanya]);

    return response()->json(['message' => 'Personatge afegit a la campanya correctament!'], 200);
}


public function personatgesdeCampanya($id_campanya)
{
    $campanya = Campanya::withCount('personatges')->find($id_campanya);

    if (!$campanya) {
        return response()->json(['error' => 'Campanya no trobada'], 404);
    }

    return response()->json(['personatges_count' => $campanya->personatges_count], 200);
}

public function getClassesByCampanya($id_campanya)
{
    $campanya = Campanya::findOrFail($id_campanya);

    $classeCampanya = DB::table('classe_campanya')
        ->where('campanya_id', $id_campanya)
        ->get();

    return response()->json([
        'campanya' => $campanya->nom,
        'classe_campanya' => $classeCampanya
    ], 200);
}

public function getPersonatgesByUser($id_campanya)
{
    $userId = Auth::id();

    if (!$userId) {
        return response()->json(['error' => 'Usuari no autenticat'], 401);
    }

    $campanya = Campanya::findOrFail($id_campanya);

    $personatges = DB::table('personatges')
        ->where('user_id', $userId)
        ->where('joc_id', $campanya->joc_id)
        ->whereNull('campanya_id')
        ->get();

    return response()->json([
        'user_id' => $userId,
        'personatges' => $personatges
    ], 200);
}

public function checkGetPersonatges($id_campanya)
{
    $campanya = Campanya::findOrFail($id_campanya);

    $maxPersonatges = $campanya->personatges;

    // Obtener el conteo de personajes en la campaña
    $response = $this->personatgesdeCampanya($id_campanya);
    $PersonatgesCount = $response->getData()->personatges_count;

    if ($PersonatgesCount >= $maxPersonatges) {
        return response()->json([
            'error' => true,
            'message' => 'No es poden afegir més personatges a aquesta campanya. Màxim permès: ' . $maxPersonatges,
        ]);
    }

    // Obtener las clases asociadas a la campaña
    $classesResponse = $this->getClassesByCampanya($id_campanya);
    $classeCampanya = json_decode($classesResponse->getContent())->classe_campanya;

    // Obtener los personajes del usuario
    $userPersonatgesResponse = $this->getPersonatgesByUser($id_campanya);
    $userPersonatgesData = json_decode($userPersonatgesResponse->getContent());

    if (!isset($userPersonatgesData->personatges)) {
        return response()->json(['error' => 'No s\'han trobat personatges per a l\'usuari.'], 404);
    }

    $userPersonatges = collect($userPersonatgesData->personatges);

    $classeIds = collect($classeCampanya)->pluck('classe_id')->toArray();

    $allowAnyClasse = in_array(null, $classeIds);

    $filteredPersonatges = $userPersonatges->filter(function ($personatge) use ($classeIds, $allowAnyClasse) {
        return $allowAnyClasse || in_array($personatge->classe_id, $classeIds);
    });

    return response()->json([
        'campanya' => $campanya->nom,
        'max_personatges' => $maxPersonatges,
        'personatges_count' => $PersonatgesCount,
        'remaining_slots' => $maxPersonatges - $PersonatgesCount,
        'filtered_personatges' => $filteredPersonatges->values()
    ], 200);
}


}
