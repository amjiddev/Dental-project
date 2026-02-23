<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Mail\AppointmentConfirmation;
use App\Mail\AppointmentNotification;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function create()
    {
        $services = Service::active()->ordered()->get();
        $doctors = Doctor::active()->ordered()->get();
        
        return view('frontend.appointment', compact('services', 'doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'service_id' => 'nullable|exists:services,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'message' => 'nullable|string|max:1000',
        ]);

        $validated['status'] = 'pending';

        $appointment = Appointment::create($validated);

        // Send confirmation email to patient
        try {
            Mail::to($appointment->email)->send(new AppointmentConfirmation($appointment));
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Log::error('Failed to send appointment confirmation email: ' . $e->getMessage());
        }

        // Send notification email to admin
        try {
            $adminEmail = env('MAIL_FROM_ADDRESS', 'admin@dentalclinic.com');
            Mail::to($adminEmail)->send(new AppointmentNotification($appointment));
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Log::error('Failed to send appointment notification email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Your appointment has been booked successfully! We will contact you soon to confirm.');
    }
}
