<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function create($orderId)
    {
        $order = Order::findOrFail($orderId);

        return view('prescription.upload', compact('order'));
    }

    public function store(Request $request, $orderId)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf|max:5120',
            'observations' => 'nullable|string|max:1000',
        ]);

        $path = $request->file('file')
            ->store('prescriptions', 'public');

        Prescription::create([
            'order_id' => $orderId,
            'file' => $path,
            'observations' => $request->observations,
        ]);

        return redirect()
            ->route('orders')
            ->with('success', 'Receita enviada com sucesso.');
    }
}