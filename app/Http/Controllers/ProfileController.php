<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load([
            'addresses',
            'visionProfile',
            'orders.items.product',
            'wishlist',
        ]);

        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'cpf' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
        ]);

        Auth::user()->update($data);

        return back()->with('success', 'Perfil atualizado com sucesso.');
    }
}
