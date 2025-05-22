<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->tipus_usuari !== 'admin') {
            return redirect()->route('users.index')->with('error', 'Acceso no autorizado');
        }

        $query = User::query();

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $users = $query->get();

        return view('users.index', compact('users'));
    }

    public function edit(Request $request, $id)
    {
        if (Auth::user()->tipus_usuari !== 'admin') {
            return redirect()->route('users.index')->with('error', 'Acceso no autorizado');
        }

        $user = User::findOrFail($id);

        // No permitir editar admins
        if ($user->tipus_usuari === 'admin') {
            return redirect()->route('users.index')->with('error', 'No es pot editar un usuari admin.');
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'tipus_usuari' => 'required|in:dm,user',
            ]);

            $user->tipus_usuari = $request->tipus_usuari;
            $user->save();

            return redirect()->route('users.index')->with('status', "Tipus d'usuari actualitzat correctament.");
        }

        return view('users.edit', compact('user'));
    }
}
