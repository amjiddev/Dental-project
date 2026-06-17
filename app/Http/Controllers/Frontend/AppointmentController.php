<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Doctor;
use App\Models\TreatmentOption;
use Illuminate\Http\Request;
use App\Mail\AppointmentConfirmation;
use App\Mail\AppointmentNotification;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function create(Request $request)
    {
        $services = Service::active()->ordered()->get();
        $doctors = Doctor::active()->ordered()->get();
        
        // Get pre-selected service and treatment from query parameters
        $selectedServiceId = $request->query('service_id');
        $selectedTreatmentId = $request->query('treatment_id');
        
        // Get treatment options for the selected service from database
        $treatments = [];
        if ($selectedServiceId) {
            $treatments = TreatmentOption::where('service_id', $selectedServiceId)
                ->where('is_active', true)
                ->orderBy('order', 'asc')
                ->get()
                ->toArray();
        }
        
        return view('frontend.appointment', compact('services', 'doctors', 'selectedServiceId', 'selectedTreatmentId', 'treatments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => 'required|regex:/^[\+]?[0-9\s\(\)\-]{10,20}$/',
            'service_id' => 'required|exists:services,id',
            'treatment_option_id' => 'nullable|exists:treatment_options,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'message' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Full name is required',
            'name.regex' => 'Full name can only contain letters and spaces',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email address',
            'phone.required' => 'Phone number is required',
            'phone.regex' => 'Phone number format invalid. Use formats like: +1 (622) 936-6659, +92-300-1234567, or 3001234567',
            'phone.digits_between' => 'Phone number must be between 10 and 15 digits',
            'service_id.required' => 'Please select a service',
            'appointment_date.required' => 'Please select a date',
            'appointment_date.after_or_equal' => 'Appointment date must be today or later',
            'appointment_time.required' => 'Please select a time',
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
