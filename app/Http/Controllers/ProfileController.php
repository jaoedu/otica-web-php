<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();

        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()
            ->route('profile.index')
            ->with('success', 'Perfil atualizado com sucesso.');
    }

    public function destroy(): RedirectResponse
    {
        $user = Auth::user();

        if (! Hash::check(request('password'), $user->password)) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ])->errorBag('userDeletion');
        }

        Auth::logout();

        $user->delete();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
