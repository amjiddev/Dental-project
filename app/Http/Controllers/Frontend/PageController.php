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
        return view('frontend.pages.about', compact('doctors'));
    }

    public function team()
    {
        $doctors = Doctor::active()->ordered()->get();
        return view('frontend.pages.team', compact('doctors'));
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
        return view('frontend.pages.contact');
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
