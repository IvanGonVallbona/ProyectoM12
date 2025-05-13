<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Campanya;
use App\Models\Classe;
use App\Models\Manual;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                'personatges' => 'required|integer|min:3|max:6',
                'classe_*' => 'nullable|exists:classes,id', // Se permite null
            ]);

            // Crear la campanya
            $campanya = new Campanya();
            $campanya->nom = $request->nom;
            $campanya->descripcio = $request->descripcio;
            $campanya->estat = $request->estat;
            $campanya->joc_id = $request->joc_id;
            $campanya->user_id = Auth::id() ?? $request->user_id;
            $campanya->personatges = $request->personatges;
            $campanya->save();

            // Guardar les classes seleccionades
            for ($i = 1; $i <= $request->personatges; $i++) {
                $classeId = $request->input("classe_$i");
                
                // Si la opció està buida, guardem NULL explícitament
                if ($classeId === null) {
                    // Inserción directa con DB para asegurar que se guarde NULL
                    // Inserció directa amb la BBDD per a que es guardi null
                    DB::table('classe_campanya')->insert([
                        'campanya_id' => $campanya->id,
                        'classe_id' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    // Per a les opcions que no null, fem servir el mètode attach normal
                    $campanya->classes()->attach($classeId, [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            return redirect()->route('campanya_list')
                ->with('status', 'Nova campanya "' . $campanya->nom . '" creada!');
        }

        $manuals = Manual::all();
        $classes = Classe::all();
        return view('campanya.new', ['manuals' => $manuals, 'classes' => $classes]);
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
                'personatges' => 'required|integer|min:3|max:6',
                'classe_*' => 'nullable|exists:classes,id',
            ]);

            // Actualitzar dades bàsiques
            $campanya->nom = $request->nom;
            $campanya->descripcio = $request->descripcio;
            $campanya->estat = $request->estat;
            $campanya->joc_id = $request->joc_id;
            $campanya->user_id = $request->user_id;

            $campanya->save();

            // 🔄 Eliminar TOTES les relacions existents
            DB::table('classe_campanya')->where('campanya_id', $campanya->id)->delete();

            // 🔁 Tornar a inserir una entrada per a cada personatge
            for ($i = 1; $i <= $request->personatges; $i++) {
                $classeId = $request->input("classe_$i");

                DB::table('classe_campanya')->insert([
                    'campanya_id' => $campanya->id,
                    'classe_id' => empty($classeId) ? null : $classeId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->route('campanya_list')
                ->with('status', 'Campanya "' . $campanya->nom . '" actualitzada!');
        }

        $manuals = Manual::all();
        $classes = Classe::all();

        // 🔄 Recuperar totes les classes assignades a la campanya, inclosos nulls
        $classesAssignades = DB::table('classe_campanya')
            ->where('campanya_id', $campanya->id)
            ->pluck('classe_id')
            ->toArray();

        return view('campanya.edit', [
            'campanya' => $campanya,
            'manuals' => $manuals,
            'classes' => $classes,
            'classesAssignades' => $classesAssignades,
        ]);
    }


    public function delete($id)
    {
        $campanya = Campanya::findOrFail($id);
        $nom = $campanya->nom;
        $campanya->delete();
        return redirect()->route('campanya_list')
            ->with('status', 'Campanya "' . $nom . '" eliminada correctament!');
    }


    /**
     * Obtenir el nombre de personatges associats a una campanya específica.
     *
     * @param int $id_campanya
     * @return \Illuminate\Http\JsonResponse
     */
    public function personatgesdeCampanya($id_campanya)
    {
        // Buscar la campaña por ID
        $campanya = Campanya::withCount('personatges')->find($id_campanya);

        // Verificar si la campaña existe
        if (!$campanya) {
            return response()->json(['error' => 'Campanya no trobada'], 404);
        }

        // Retornar el conteo de personajes asociados a la campaña
        return response()->json(['personatges_count' => $campanya->personatges_count], 200);
    }

    /**
     * Obtenir les classes associades a una campanya específica.
     *
     * @param int $id_campanya
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClassesByCampanya($id_campanya)
    {
        // Verificar si la campaña existe
        $campanya = Campanya::findOrFail($id_campanya);

        // Obtener los datos de la tabla intermedia
        $classeCampanya = DB::table('classe_campanya')
            ->where('campanya_id', $id_campanya)
            ->get();

        // Retornar los datos de la tabla intermedia
        return response()->json([
            'campanya' => $campanya->nom,
            'classe_campanya' => $classeCampanya
        ], 200);
    }

    /**
     * Obtenir els personatges associats a l'usuari actual sense camapanya
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPersonatgesByUser($id_campanya)
    {
        // Obtener el usuario actual
        $userId = Auth::id();

        // Verificar si el usuario está autenticado
        if (!$userId) {
            return response()->json(['error' => 'Usuari no autenticat'], 401);
        }

        // Obtener la campaña por ID
        $campanya = Campanya::findOrFail($id_campanya);

        // Obtener los personajes del usuario actual que pertenecen al mismo juego que la campaña
        $personatges = DB::table('personatges')
            ->where('user_id', $userId) // Filtrar por el ID del usuario actual
            ->where('joc_id', $campanya->joc_id) // Filtrar por el mismo juego que la campaña
            ->whereNull('campanya_id') // Filtrar por personajes que no están asignados a ninguna campaña
            ->get();

        // Retornar los datos de los personajes
        return response()->json([
            'user_id' => $userId,
            'personatges' => $personatges
        ], 200);
    }

    public function checkGetPersonatges($id_campanya)
    {
        // Obtener la campaña por ID
        $campanya = Campanya::findOrFail($id_campanya);

        // Obtener el número máximo de personajes permitidos en la campaña
        $maxPersonatges = $campanya->personatges;

        // Llamar a la función personatgesdeCampanya para obtener el número actual de personajes en la campaña
        $response = $this->personatgesdeCampanya($id_campanya);
        $PersonatgesCount = $response->getData()->personatges_count;

        // Verificar si se pueden añadir más personajes
        if ($PersonatgesCount >= $maxPersonatges) {
            // Si el número actual de personajes alcanza el máximo, devolver un error
            return response()->json([
                'error' => true,
                'message' => 'No es poden afegir més personatges a aquesta campanya. Màxim permès: ' . $maxPersonatges,
            ]);
        }


        // Llamar a la función getClassesByCampanya para obtener las clases asociadas a la campaña
        $classesResponse = $this->getClassesByCampanya($id_campanya);
        $classeCampanya = $classesResponse->getData()->classe_campanya;

        // Llamar a la función getPersonatgesByUser para obtener los personajes del usuario actual
        $userPersonatgesResponse = $this->getPersonatgesByUser($id_campanya);
        $userPersonatges = collect($userPersonatgesResponse->getData()->personatges);

        // Obtener los IDs de las clases asociadas a la campaña
        $classeIds = collect($classeCampanya)->pluck('classe_id')->toArray();

        // Verificar si alguna clase asociada tiene 'classe_id' como null, que indica que se permite cualquier clase
        $allowAnyClasse = in_array(null, $classeIds);

        // Filtrar los personajes del usuario actual que pertenecen a las clases asociadas
        $filteredPersonatges = $userPersonatges->filter(function ($personatge) use ($classeIds, $allowAnyClasse) {
            // Si $allowAnyClasse es true, significa que se permite cualquier clase
            // Si no, devolver solo los personajes cuya `classe_id` esté en la lista de clases asociadas
            return $allowAnyClasse || in_array($personatge->classe_id, $classeIds);
        });

        // Retornar los personajes filtrados junto con información adicional de la campaña
        return response()->json([
            'campanya' => $campanya->nom,
            'max_personatges' => $maxPersonatges,
            'personatges_count' => $PersonatgesCount,
            'remaining_slots' => $maxPersonatges - $PersonatgesCount,
            'filtered_personatges' => $filteredPersonatges->values()
        ], 200);
    }

    public function addPersonatge($id_campanya)
    {
        // Obtener los datos de la campaña
        $campanya = Campanya::findOrFail($id_campanya);

        // Obtener los personajes permitidos utilizando la lógica de checkGetPersonatges
        $response = $this->checkGetPersonatges($id_campanya);

        $data = $response->getData();
        if (isset($data->error) && $data->error) {
            return redirect()->route('campanya_list')
            ->with('error', $data->message);
        }

        // Redirigir a la vista con los datos de la campaña y los personajes permitidos
        return view('campanya.addPersonatge', [
            'campanya' => $campanya,
            'filteredPersonatges' => collect($data->filtered_personatges),
            'remaining_slots' => $data->remaining_slots
        ]);
    }

    /**
     * Assignar un personatge a una campanya.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id_campanya
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addPersonatgeToCampanya($id_campanya, $id_personatge)
    {
        // Verificar si el personatge existeix
        $personatge = DB::table('personatges')->where('id', $id_personatge)->first();
        if (!$personatge) {
            return redirect()->route('campanya_list')
                ->with('error', 'Personatge no trobat.');
        }

        // Verificar si el personatge ja està assignat a una campanya
        if ($personatge->campanya_id) {
            return redirect()->route('campanya_list')
                ->with('error', 'El personatge ja està assignat a una altra campanya.');
        }

        // Obtener la campaña por ID
        $campanya = Campanya::findOrFail($id_campanya);
        if (!$campanya) {
            return redirect()->route('campanya_list')
                ->with('error', 'Campanya no trobada.');
        }

        // Verificar si el nombre de personatges en la campanya ha arribat al màxim
        $personatgesCount = DB::table('personatges')
            ->where('campanya_id', $id_campanya)
            ->count();
        if ($personatgesCount >= $campanya->personatges) {
            return redirect()->route('campanya_list')
                ->with('error', 'No es poden afegir més personatges a aquesta campanya.');
        }

        // Verificar si el personatge pertany al mateix joc que la campanya
        if ($personatge->joc_id !== $campanya->joc_id) {
            return redirect()->route('campanya_list')
                ->with('error', 'El personatge no pertany al mateix joc que la campanya.');
        }

        // Actualitzar el personatge per assignar-lo a la campanya
        DB::table('personatges')
            ->where('id', $id_personatge)
            ->update(['campanya_id' => $id_campanya]);

        if (!$personatge) {
            return redirect()->route('campanya_list')
                ->with('error', 'No s\'ha pogut afegir el personatge a la campanya.');
        }

        // Eliminar la entrada correspondiente en la tabla classe_campanya
        $deleted = DB::table('classe_campanya')
            ->where('campanya_id', $id_campanya)
            ->where('classe_id', $personatge->classe_id) // Buscar por la clase específica
            ->delete();

        // Si no se eliminó ninguna entrada específica, eliminar la entrada con classe_id = null
        if ($deleted === 0) {
            $deleted = DB::table('classe_campanya')
                ->where('campanya_id', $id_campanya)
                ->whereNull('classe_id')
                ->delete();
        }

        if ($deleted === 0) {
            return redirect()->route('campanya_list')
                ->with('error', 'No s\'ha pogut eliminar la classe associada al personatge.');
        }

        // Si tot és correcte, redirigir a la llista de campanyes amb un missatge d'èxit
        return redirect()->route('campanya_list')
            ->with('status', 'Personatge afegit a la campanya "' . $campanya->nom . '"!');
    }

}