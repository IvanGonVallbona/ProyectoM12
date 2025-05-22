<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Filtra els resultats d'un model pel camp joc_id.
     *
     * @param string $model El nom complet de la classe del model (ex: Classe::class)
     * @param \Illuminate\Http\Request $request La request que pot contenir el paràmetre 'joc_id'
     * @return array [resultats filtrats, joc_id seleccionat]
     */
    public function filtraPerJoc($model, $request)
    {
        $joc_id = $request->input('joc_id');
        $query = $model::with('manual');
        if ($joc_id) {
            $query->where('joc_id', $joc_id);
        }
        return [$query->get(), $joc_id];
    }
}
