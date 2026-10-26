<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function show(Doctor $doctor)
    {
        // Get lead doctor
        $leadDoctor = Doctor::where('is_lead_doctor', true)->where('is_active', true)->first();
        
        // Get all active doctors
        $doctors = Doctor::active()->ordered()->get();
        
        // If doctor is not active, redirect to team page
        if (!$doctor->is_active) {
            return redirect()->route('team');
        }

        return view('frontend.pages.doctor-detail', compact('doctor', 'leadDoctor', 'doctors'));
    }
}
