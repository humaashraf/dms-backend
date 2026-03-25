<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\Donation;

class PaymentMethodController extends Controller
{
    public function index()
    {
        return response()->json(PaymentMethod::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $method = PaymentMethod::create($validated);
        return response()->json($method, 201);
    }

    public function show($id)
    {
        $method = PaymentMethod::find($id);
        if (!$method) {
            return response()->json(['message' => 'Payment Method not found'], 404);
        }
        return response()->json($method);
    }

    public function update(Request $request, $id)
    {
        $method = PaymentMethod::find($id);
        if (!$method) {
            return response()->json(['message' => 'Payment Method not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required',
        ]);

        $method->update($validated);
        return response()->json($method);
    }

    public function destroy($id)
    {
        $isUsed = Donation::where('payment_method_id', $id)->exists();

        if ($isUsed) {
            return response()->json(['error' => 'Cannot delete this Payment Method because it is being used in Donations.'], 400);
        }

        PaymentMethod::destroy($id);
        return response()->json(['message' => 'Payment Method deleted successfully']);
    }
}
