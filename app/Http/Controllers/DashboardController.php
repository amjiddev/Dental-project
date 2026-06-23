<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\ContactMessage;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Discount;
use App\Models\BlogPost;
use App\Models\Testimonial;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // Core stats
        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $confirmedAppointments = Appointment::where('status', 'confirmed')->count();
        $completedAppointments = Appointment::where('status', 'completed')->count();
        $cancelledAppointments = Appointment::where('status', 'cancelled')->count();

        $totalDoctors = Doctor::count();
        $activeDoctors = Doctor::where('is_active', true)->count();
        $totalServices = Service::where('is_active', true)->count();
        $totalDiscounts = Discount::where('is_active', true)->count();

        $totalBlogs = BlogPost::count();
        $totalTestimonials = Testimonial::count();
        $totalGalleryItems = Gallery::count();
        $totalUsers = User::count();
        $notificationCount = $pendingAppointments;

        // Confirmation rate
        $confirmationRate = $totalAppointments > 0 ? round(($confirmedAppointments / $totalAppointments) * 100, 1) : 0;
        $pendingRate = $totalAppointments > 0 ? round(($pendingAppointments / $totalAppointments) * 100, 1) : 0;

        // This month vs last month
        $now = now();
        $thisMonthAppointments = Appointment::whereMonth('appointment_date', $now->month)
            ->whereYear('appointment_date', $now->year)
            ->count();
        $lastMonth = $now->copy()->subMonth();
        $lastMonthAppointments = Appointment::whereMonth('appointment_date', $lastMonth->month)
            ->whereYear('appointment_date', $lastMonth->year)
            ->count();
        $appointmentGrowth = $lastMonthAppointments > 0
            ? round((($thisMonthAppointments - $lastMonthAppointments) / $lastMonthAppointments) * 100, 1)
            : 0;

        // Daily appointments for last 7 days (Sales Report chart)
        $dailyAppointments = [];
        $daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->copy()->subDays($i);
            $count = Appointment::whereDate('appointment_date', $date->toDateString())->count();
            $dailyAppointments[] = [
                'day' => $daysOfWeek[$date->dayOfWeek],
                'count' => $count,
            ];
        }

        // Monthly appointments for last 12 months (User Stats chart)
        $monthlyAppointments = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->copy()->subMonths($i);
            $count = Appointment::whereMonth('appointment_date', $date->month)
                ->whereYear('appointment_date', $date->year)
                ->count();
            $monthlyAppointments[] = [
                'month' => $date->format('M'),
                'count' => $count,
            ];
        }

        // Service-wise appointment distribution
        $serviceAppointments = Appointment::selectRaw('service_id, COUNT(*) as count')
            ->with('service')
            ->groupBy('service_id')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        // Recent appointments
        $recentAppointments = Appointment::with(['service', 'doctor'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Upcoming appointments
        $upcomingAppointments = Appointment::with(['service', 'doctor'])
            ->upcoming()
            ->limit(5)
            ->get();

        // Filtered lists for modals
        $allAppointments = Appointment::with(['service', 'doctor'])
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        $confirmedList = Appointment::with(['service', 'doctor'])
            ->where('status', 'confirmed')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        $pendingList = Appointment::with(['service', 'doctor'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        $completedList = Appointment::with(['service', 'doctor'])
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        return view('pages.dashboard', compact(
            'totalAppointments', 'pendingAppointments', 'confirmedAppointments', 'completedAppointments',
            'cancelledAppointments',
            'totalDoctors', 'activeDoctors', 'totalServices', 'totalDiscounts',
            'totalBlogs', 'totalTestimonials', 'totalGalleryItems', 'totalUsers',
            'confirmationRate', 'pendingRate', 'notificationCount',
            'thisMonthAppointments', 'lastMonthAppointments', 'appointmentGrowth',
            'dailyAppointments', 'monthlyAppointments', 'serviceAppointments',
            'recentAppointments', 'upcomingAppointments',
            'allAppointments', 'confirmedList', 'pendingList', 'completedList'
        ));
    }
}
