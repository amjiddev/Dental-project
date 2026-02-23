<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Doctor;
use App\Models\Testimonial;
use App\Models\BlogPost;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::active()->ordered()->get();
        $doctors = Doctor::active()->ordered()->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();
        $latestPosts = BlogPost::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('frontend.pages.home', compact('services', 'doctors', 'testimonials', 'latestPosts'));
    }
}
