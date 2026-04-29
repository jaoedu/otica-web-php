<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'label' => 'required|string|max:50',
            'zip_code' => 'required|string|max:20',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:20',
            'complement' => 'nullable|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'is_default' => 'nullable|boolean',
        ]);

        $data['user_id'] = Auth::id();
        $data['is_default'] = $request->boolean('is_default');

        if ($data['is_default']) {
            Address::where('user_id', Auth::id())->update([
                'is_default' => false,
            ]);
        }

        Address::create($data);

        return back()->with('success', 'Endereço cadastrado com sucesso.');
    }

    public function destroy(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        $address->delete();

        return back()->with('success', 'Endereço removido com sucesso.');
    }
}
