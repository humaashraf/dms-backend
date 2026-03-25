<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;

class CurrencyController extends Controller
{
    // GET /api/currencies
    public function index()
    {
        $currencies = Currency::all();
        return response()->json($currencies);
    }

    // POST /api/currencies
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'code' => 'required|string|max:10|unique:currencies,code',
            'symbol' => 'required|string|max:10',
        ]);

        $currency = Currency::create($request->all());

        return response()->json([
            'message' => 'Currency created successfully.',
            'data' => $currency
        ]);
    }

    // GET /api/currencies/{id}
    public function show($id)
    {
        $currency = Currency::find($id);
        if (!$currency) {
            return response()->json(['message' => 'Currency not found.'], 404);
        }

        return response()->json($currency);
    }

    // PUT /api/currencies/{id}
    public function update(Request $request, $id)
    {
        $currency = Currency::find($id);
        if (!$currency) {
            return response()->json(['message' => 'Currency not found.'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:50',
            'code' => 'required|string|max:10|unique:currencies,code,' . $id,
            'symbol' => 'required|string|max:10',
        ]);

        $currency->update($request->all());

        return response()->json([
            'message' => 'Currency updated successfully.',
            'data' => $currency
        ]);
    }

    // DELETE /api/currencies/{id}
    public function destroy($id)
    {
        $currency = Currency::find($id);
        if (!$currency) {
            return response()->json(['message' => 'Currency not found.'], 404);
        }

        $currency->delete();

        return response()->json(['message' => 'Currency deleted successfully.']);
    }
}
