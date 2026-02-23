<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::active()->ordered()->paginate(12);
        return view('frontend.doctors.index', compact('doctors'));
    }

    public function show($id)
    {
        $doctor = Doctor::where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();

        return view('frontend.doctors.show', compact('doctor'));
    }
}
