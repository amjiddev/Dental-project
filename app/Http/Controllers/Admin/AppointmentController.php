<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['service', 'doctor'])
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->paginate(15);
        
        return view('admin.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['service', 'doctor']);
        return view('admin.appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $services = Service::active()->ordered()->get();
        $doctors = Doctor::active()->ordered()->get();
        
        return view('admin.appointments.edit', compact('appointment', 'services', 'doctors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'service_id' => 'nullable|exists:services,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'message' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $appointment->update($validated);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $appointment->update(['status' => $validated['status']]);

        // Email sending temporarily disabled
        // Uncomment below code to enable email notifications
        /*
        $oldStatus = $appointment->status;
        
        if ($validated['status'] === 'confirmed' && $oldStatus !== 'confirmed') {
            try {
                \Mail::to($appointment->email)->send(new \App\Mail\AppointmentConfirmation($appointment));
            } catch (\Exception $e) {
                \Log::error('Failed to send appointment confirmation email: ' . $e->getMessage());
            }
        }
        */

        return redirect()->back()
            ->with('success', 'Appointment status updated successfully.');
    }
}
