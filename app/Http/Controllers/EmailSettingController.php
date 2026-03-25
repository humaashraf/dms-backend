<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailSetting;

class EmailSettingController extends Controller
{
    // GET /api/email-settings/{id}
    public function edit($id)
    {
        $setting = EmailSetting::find($id);
        if (!$setting) {
            return response()->json(['success' => false, 'message' => 'Setting not found.'], 404);
        }

        return response()->json(['success' => true, 'data' => $setting]);
    }

    // PUT /api/email-settings/{id}
    public function update($id, Request $request)
    {
        $request->validate([
            'smtp_host' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'smtp_secure' => 'required|string',
            'port' => 'required|numeric',
            'from_email' => 'required|email',
        ]);

        $setting = EmailSetting::find($id);
        if (!$setting) {
            return response()->json(['success' => false, 'message' => 'Setting not found.'], 404);
        }

        $setting->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Email settings updated successfully!',
            'data' => $setting
        ]);
    }
}
