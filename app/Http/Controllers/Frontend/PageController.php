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
            'name' => 'required|string|min:2|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => 'nullable|string|min:10|max:20|regex:/^[0-9\s\-\+\(\)]+$/',
            'subject' => 'required|string|min:3|max:255',
            'message' => 'required|string|min:10|max:2000',
        ], [
            'name.required' => 'Please enter your name.',
            'name.min' => 'Name must be at least 2 characters.',
            'name.regex' => 'Name can only contain letters and spaces, no numbers allowed.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'phone.regex' => 'Please enter a valid phone number.',
            'subject.required' => 'Please enter a subject.',
            'subject.min' => 'Subject must be at least 3 characters.',
            'message.required' => 'Please enter your message.',
            'message.min' => 'Message must be at least 10 characters.',
            'message.max' => 'Message cannot exceed 2000 characters.',
        ]);

        // Store the message in the database
        \App\Models\ContactMessage::create($validated);

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
