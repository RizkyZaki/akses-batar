<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
  public function index()
  {
    return view('pages.settings.index', [
      'title' => 'Pengaturan',
    ]);
  }
  public function store(Request $request)
  {
    $setting = Settings::first();

    $validated = $request->validate([
      'app_name' => 'required|string|max:255',
      'email' => 'nullable|email',
      'phone' => 'nullable|string|max:50',
      'address' => 'nullable|string',
      'footer_text' => 'nullable|string',
      'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
    ]);

    if ($request->file('logo')) {
      $eks = $request->file('logo')->getClientOriginalExtension();
      $request->file('logo')->storeAs('img', md5($request->input('name')) . '.' . $eks);
      $validatedData['logo'] = md5($request->input('name')) . '.' . $eks;
    }

    $setting->update($validated);

    return redirect()->route('settings')->with('success', 'Pengaturan berhasil diperbarui.');
  }
}
