<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    /**
     * Display a listing of the settings by sections.
     */
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('Backend.settings.index', compact('settings'));
    }

    /**
     * Update specified settings bulk.
     */
    public function updateSettings(Request $request)
    {
        $items = $request->except('_token');

        foreach ($items as $key => $value) {
            if ($request->hasFile($key)) {
                $setting = Setting::where('key', $key)->first();
                // Delete old file
                if ($setting && $setting->value && File::exists(public_path('uploads/settings/' . $setting->value))) {
                    File::delete(public_path('uploads/settings/' . $setting->value));
                }

                $fileName = $key . '_' . time() . '.' . $request->file($key)->extension();
                $request->file($key)->move(public_path('uploads/settings'), $fileName);
                $value = $fileName;
            }

            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
