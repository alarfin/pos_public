<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function add(Request $request)
    {
        $setting = Setting::where('client_id', Auth::user()->client_id)->first();
        return view('administrator.setting.add', compact('setting'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'nullable|string|max:255',
            'logo' => 'nullable|image',
        ]);

        $setting = Setting::where('client_id', Auth::user()->client_id)->first();
        $data = $request->all();
        if ($request->hasFile('logo')) {
            if ($setting && $setting->logo) {
                Storage::delete($setting->logo);
            }
            $data['logo'] = $request->logo->store('/public/setting');
        }
        if ($setting) {
            $setting->update($data);
        } else {
            Setting::create($data);
        }
        return redirect()->back()->with('success', 'Setting updated successfully done.');
    }
}
