<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisionProfileController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate([
            'uses_glasses' => 'nullable|boolean',
            'lens_type' => 'nullable|string|max:100',
            'condition' => 'nullable|string|max:100',
            'light_sensitivity' => 'nullable|boolean',
            'observations' => 'nullable|string|max:1000',
        ]);

        $data['uses_glasses'] = $request->boolean('uses_glasses');
        $data['light_sensitivity'] = $request->boolean('light_sensitivity');

        Auth::user()->visionProfile()->updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );

        return back()->with('success', 'Perfil visual atualizado com sucesso.');
    }
}
