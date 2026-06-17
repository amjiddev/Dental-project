<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Gallery;
use App\Models\Setting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $doctors = Doctor::active()->ordered()->get();
        $settings = Setting::where('key', 'like', 'about_%')
            ->orWhere('key', 'like', 'mission_%')
            ->orWhere('key', 'like', 'vision_%')
            ->orWhere('key', 'like', 'about_image')
            ->pluck('value', 'key')
            ->toArray();
        return view('frontend.pages.about', compact('doctors', 'settings'));
    }

    public function team()
    {
        $doctors = Doctor::active()->ordered()->get();
        $leadDoctor = Doctor::where('is_lead_doctor', true)->where('is_active', true)->first();
        return view('frontend.pages.team', compact('doctors', 'leadDoctor'));
    }

    public function discounts()
    {
        $discounts = \App\Models\Discount::active()->ordered()->get();
        return view('frontend.pages.discounts', compact('discounts'));
    }

    public function gallery()
    {
        // Using lazy loading for better performance
        $images = Gallery::where('is_active', true)
            ->orderBy('order')
            ->select('id', 'title', 'image', 'description', 'order')
            ->paginate(9);

        return view('frontend.pages.gallery', compact('images'));
    }

    public function contact()
    {
        $settings = Setting::where('key', 'like', 'contact_%')
            ->orWhere('key', 'like', 'map_%')
            ->pluck('value', 'key')
            ->toArray();
        return view('frontend.pages.contact', compact('settings'));
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Here you can send email or store in database
        // For now, just return success message
        
        return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }

    public function terms()
    {
        return view('frontend.pages.terms');
    }

    public function privacy()
    {
        return view('frontend.pages.privacy');
    }
}
