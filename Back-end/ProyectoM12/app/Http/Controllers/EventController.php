<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Esdeveniment;
use App\Models\Campanya;

class EventController extends Controller
{
    public function index()
    {
        $esdeveniments = Esdeveniment::where('data', '>', now())->with('creador')->get();

        $campanyes = Campanya::with(['manual', 'user', 'personatgesCampanya'])
            ->where('estat', 'preparacio')
            ->get()
            ->filter(function($campanya) {
                return $campanya->personatgesCampanya->count() < $campanya->personatges;
            });

        return view('events.index', [
            'esdeveniments' => $esdeveniments,
            'campanyes' => $campanyes,
        ]);
    }
}
