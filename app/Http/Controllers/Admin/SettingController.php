<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function about()
    {
        $settings = Setting::where('key', 'like', 'about_%')
            ->orWhere('key', 'like', 'mission_%')
            ->orWhere('key', 'like', 'vision_%')
            ->pluck('value', 'key')
            ->toArray();

        return view('admin.settings.about', compact('settings'));
    }

    public function updateAbout(Request $request)
    {
        $validated = $request->validate([
            'about_heading' => 'required|string|max:255',
            'about_subtitle' => 'required|string|max:500',
            'about_description' => 'required|string',
            'about_feature_1' => 'required|string|max:255',
            'about_feature_2' => 'required|string|max:255',
            'about_feature_3' => 'required|string|max:255',
            'about_feature_4' => 'required|string|max:255',
            'mission_title' => 'required|string|max:255',
            'mission_description' => 'required|string',
            'mission_icon' => 'required|string|max:255',
            'vision_title' => 'required|string|max:255',
            'vision_description' => 'required|string',
            'vision_icon' => 'required|string|max:255',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        if ($request->hasFile('about_image')) {
            $request->validate([
                'about_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $oldImage = Setting::get('about_image');
            if ($oldImage) {
                ImageUploadService::delete($oldImage);
            }

            Setting::set('about_image', ImageUploadService::upload($request->file('about_image'), 'about'));
        }

        Cache::forget('app_settings_all');
        Cache::forget('contact_settings');
        Cache::forget('footer_services');

        return redirect()->route('admin.settings.about')
            ->with('success', 'About Us settings updated successfully.');
    }

    public function home()
    {
        $settings = Setting::where('key', 'like', 'home_%')
            ->orWhere('key', 'like', 'about_image')
            ->pluck('value', 'key')
            ->toArray();

        return view('admin.settings.home', compact('settings'));
    }

    public function updateHome(Request $request)
    {
        $validated = $request->validate([
            'home_hero_title' => 'required|string|max:255',
            'home_hero_description' => 'required|string|max:1000',
            'home_stat_1_number' => 'required|string|max:50',
            'home_stat_1_label' => 'required|string|max:255',
            'home_stat_1_icon' => 'required|string|max:255',
            'home_stat_2_number' => 'required|string|max:50',
            'home_stat_2_label' => 'required|string|max:255',
            'home_stat_2_icon' => 'required|string|max:255',
            'home_stat_3_number' => 'required|string|max:50',
            'home_stat_3_label' => 'required|string|max:255',
            'home_stat_3_icon' => 'required|string|max:255',
            'home_stat_4_number' => 'required|string|max:50',
            'home_stat_4_label' => 'required|string|max:255',
            'home_stat_4_icon' => 'required|string|max:255',
            'home_about_heading' => 'required|string|max:255',
            'home_about_description' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        // Toggle switches
        $toggles = [
            'home_show_services',
            'home_show_excellence',
            'home_show_lead_surgeon',
            'home_show_expert_tips',
        ];
        foreach ($toggles as $toggle) {
            $value = $request->input($toggle, '0');
            DB::table('settings')->updateOrInsert(
                ['key' => $toggle],
                ['value' => $value, 'updated_at' => now(), 'created_at' => now()]
            );
        }

        // Hero image
        if ($request->hasFile('home_hero_image')) {
            $request->validate([
                'home_hero_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $oldImage = Setting::get('home_hero_image');
            if ($oldImage) {
                ImageUploadService::delete($oldImage);
            }

            Setting::set('home_hero_image', ImageUploadService::upload($request->file('home_hero_image'), 'home'));
        }

        // About image (shared with About Us page)
        if ($request->hasFile('about_image')) {
            $request->validate([
                'about_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $oldImage = Setting::get('about_image');
            if ($oldImage) {
                ImageUploadService::delete($oldImage);
            }

            Setting::set('about_image', ImageUploadService::upload($request->file('about_image'), 'about'));
        }

        Cache::forget('app_settings_all');
        Cache::forget('contact_settings');
        Cache::forget('footer_services');

        return redirect()->route('admin.settings.home')
            ->with('success', 'Home page settings updated successfully.');
    }

    public function toggleSection(Request $request)
    {
        try {
            $setting = $request->input('setting');
            $value = $request->input('value');

            // Validate the setting name
            $allowedSettings = [
                'home_show_services',
                'home_show_excellence',
                'home_show_lead_surgeon',
                'home_show_expert_tips',
            ];

            if (!in_array($setting, $allowedSettings)) {
                return response()->json(['success' => false, 'message' => 'Invalid setting'], 400);
            }

            // Update the setting
            DB::table('settings')->updateOrInsert(
                ['key' => $setting],
                ['value' => $value, 'updated_at' => now(), 'created_at' => now()]
            );

            // Clear cache
            Cache::forget('app_settings_all');

            return response()->json(['success' => true, 'message' => 'Setting updated']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function contact()
    {
        $settings = Setting::where('key', 'like', 'contact_%')
            ->orWhere('key', 'like', 'map_%')
            ->pluck('value', 'key')
            ->toArray();

        return view('admin.settings.contact', compact('settings'));
    }

    public function updateContact(Request $request)
    {
        $validated = $request->validate([
            'contact_heading' => 'required|string|max:255',
            'contact_subtitle' => 'required|string|max:500',
            'contact_address' => 'required|string|max:500',
            'contact_phone' => 'required|string|max:50',
            'contact_email' => 'required|email|max:255',
            'contact_hours_weekday' => 'required|string|max:255',
            'contact_hours_saturday' => 'required|string|max:255',
            'contact_hours_sunday' => 'nullable|string|max:255',
            'contact_whatsapp' => 'nullable|string|max:50',
            'contact_facebook' => 'nullable|url|max:255',
            'contact_instagram' => 'nullable|url|max:255',
            'contact_twitter' => 'nullable|url|max:255',
            'contact_linkedin' => 'nullable|url|max:255',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        // Clear all related caches
        Cache::forget('contact_settings');
        Cache::forget('footer_services');
        Cache::forget('app_settings_all');

        return redirect()->route('admin.settings.contact')
            ->with('success', 'Contact Us settings updated successfully.');
    }
}
