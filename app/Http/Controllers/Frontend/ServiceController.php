<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::active()->ordered()->get();
        
        return view('frontend.services.index', compact('services'));
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        
        // Static features - same for all services (these never change)
        $staticFeatures = [
            [
                'title' => 'Expert Specialists',
                'description' => 'Highly qualified professionals with extensive experience',
                'icon' => 'fas fa-user-md'
            ],
            [
                'title' => 'Advanced Technology',
                'description' => 'Latest equipment and cutting-edge techniques',
                'icon' => 'fas fa-microscope'
            ],
            [
                'title' => 'Patient Comfort',
                'description' => 'Your comfort and satisfaction is our priority',
                'icon' => 'fas fa-heart'
            ],
            [
                'title' => 'Safe & Hygienic',
                'description' => 'Highest safety and hygiene standards maintained',
                'icon' => 'fas fa-shield-alt'
            ]
        ];
        
        // Format service data for the view
        $serviceData = [
            'id' => $service->id,
            'title' => $service->name,
            'short_description' => $service->short_description,
            'description' => $service->description,
            'icon' => $service->icon,
            'features' => $staticFeatures,
            'treatments' => $service->treatmentOptions()->get()->map(function($treatment) {
                return [
                    'id' => $treatment->id,
                    'name' => $treatment->name,
                    'description' => $treatment->description,
                    'image' => $treatment->image,
                ];
            })->toArray(),
        ];
        
        return view('frontend.services.detail', ['service' => $serviceData]);
    }

    public function operative()
    {
        return $this->show('operative-restorative-cosmetic');
    }

    public function endodontics()
    {
        return $this->show('endodontics');
    }

    public function oralSurgery()
    {
        return $this->show('oral-maxillofacial-surgery');
    }

    public function prosthodontics()
    {
        return $this->show('prosthodontics');
    }

    public function periodontics()
    {
        return $this->show('periodontics-implantology');
    }

    public function orthodontics()
    {
        return $this->show('orthodontics');
    }

    public function pedodontics()
    {
        return $this->show('pedodontics');
    }

    public function oralMedicine()
    {
        return $this->show('oral-medicine-diagnostic-science');
    }
}
