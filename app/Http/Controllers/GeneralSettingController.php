<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\Currency;

class GeneralSettingController extends Controller
{
    // GET: api/general-settings/{id}
    public function show($id)
    {
        $setting = GeneralSetting::find($id);

        if (!$setting) {
            return response()->json([
                'message' => 'General setting not found.'
            ], 404);
        }

        $currencies = Currency::all();

        return response()->json([
            'setting' => $setting,
            'currencies' => $currencies
        ]);
    }

    // PUT: api/general-settings/{id}
    public function update($id, Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:100',
            'timezone' => 'required|string',
            'datetime_format' => 'required|string',
            'currency_id' => 'nullable|exists:currencies,id',
        ]);

        $setting = GeneralSetting::find($id);

        if (!$setting) {
            return response()->json([
                'message' => 'General setting not found.'
            ], 404);
        }

        $setting->update($request->all());

        return response()->json([
            'message' => 'Settings updated successfully!',
            'setting' => $setting
        ]);
    }
}
