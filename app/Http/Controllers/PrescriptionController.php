<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Prescription;
use App\Http\Requests\StorePrescriptionRequest;
use Illuminate\Support\Facades\Gate;

class PrescriptionController extends Controller
{
    public function create($orderId)
    {
        $order = Order::findOrFail($orderId);
        Gate::authorize('view', $order);

        return view('prescription.upload', compact('order'));
    }

    public function store(StorePrescriptionRequest $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        Gate::authorize('uploadPrescription', $order);

        $path = $request->file('file')
            ->store('prescriptions', 'public');

        Prescription::create([
            'order_id' => $order->id,
            'file' => $path,
            'observations' => $request->validated('observations'),
        ]);

        return redirect()
            ->route('orders')
            ->with('success', 'Receita enviada com sucesso.');
    }
}
