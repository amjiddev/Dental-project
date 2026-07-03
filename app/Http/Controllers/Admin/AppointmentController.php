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
        $query = Appointment::with(['service', 'doctor']);
        
        // Filter pending appointments if requested from notifications
        if (request()->has('filter') && request('filter') === 'pending') {
            $query = $query->where('status', 'pending');
        }
        
        // Handle AJAX request for modal
        if (request()->has('ajax') && request('ajax') === 'true' && request()->expectsJson()) {
            $appointments = $query->orderBy('appointment_date', 'desc')
                ->orderBy('appointment_time', 'desc')
                ->limit(50)
                ->get();
            
            return response()->json([
                'appointments' => $appointments->map(function ($appt) {
                    return [
                        'id' => $appt->id,
                        'name' => $appt->name,
                        'email' => $appt->email,
                        'phone' => $appt->phone,
                        'service' => $appt->service?->name ?? 'N/A',
                        'doctor' => $appt->doctor?->name ?? 'N/A',
                        'date' => $appt->appointment_date->format('M d, Y'),
                        'time' => date('h:i A', strtotime($appt->appointment_time)),
                        'message' => $appt->message,
                        'created_at' => $appt->created_at->format('M d, Y H:i'),
                        'time_ago' => $appt->created_at->diffForHumans(),
                    ];
                })
            ]);
        }
        
        $appointments = $query->orderBy('appointment_date', 'desc')
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

        return response()->json(['success' => true, 'message' => 'Appointment deleted successfully.']);
    }

    public function handle(Appointment $appointment)
    {
        $appointment->load(['service', 'doctor']);
        return response()->json($appointment);
    }

    public function updateHandle(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'admin_notes' => 'nullable|string',
        ]);

        $appointment->update($validated);

        return response()->json(['success' => true, 'message' => 'Appointment updated successfully.']);
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

    public function markAsSeen(Appointment $appointment)
    {
        $appointment->markAsSeen();
        
        // Return JSON if AJAX, otherwise redirect
        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->back()->with('success', 'Appointment marked as seen.');
    }
}
