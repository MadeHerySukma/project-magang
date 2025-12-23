<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSettingController extends Controller
{
    /**
     * Display settings page
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $settings = Setting::getAll();
        
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_tagline' => 'required|string|max:255',
            'company_description' => 'required|string',
            'company_phone' => 'required|string|max:50',
            'company_email' => 'required|email|max:255',
            'company_address' => 'required|string',
            'hero_image_1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'hero_image_2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'hero_image_3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'hero_image_4' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'hero_image_5' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update text settings
        Setting::set('company_name', $request->company_name);
        Setting::set('company_tagline', $request->company_tagline);
        Setting::set('company_description', $request->company_description);
        Setting::set('company_phone', $request->company_phone);
        Setting::set('company_email', $request->company_email);
        Setting::set('company_address', $request->company_address);

        // Upload hero images (1-5) jika ada
        for ($i = 1; $i <= 5; $i++) {
            $fieldName = 'hero_image_' . $i;
            
            if ($request->hasFile($fieldName)) {
                // Hapus foto lama jika ada
                $oldImage = Setting::get($fieldName);
                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }

                // Upload foto baru
                $heroImagePath = $request->file($fieldName)->store('hero', 'public');
                Setting::set($fieldName, $heroImagePath);
            }
        }

        // Clear cache
        Setting::clearCache();

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan website berhasil diupdate!');
    }
}