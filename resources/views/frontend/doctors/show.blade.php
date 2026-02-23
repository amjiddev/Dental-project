@extends('frontend.layouts.frontend')

@section('title', $doctor->name . ' - Dental Clinic')
@section('meta_description', $doctor->bio)

@section('content')

<!-- Page Header -->
<section class="dental-blue text-white py-16">
    <div class="container mx-auto px-4">
        <div class="text-center" data-aos="fade-up">
            <h1 class="text-5xl font-bold mb-4">{{ $doctor->name }}</h1>
            <p class="text-xl text-blue-100">{{ $doctor->specialization }}</p>
        </div>
    </div>
</section>

<!-- Doctor Profile -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up">
                <div class="grid grid-cols-1 md:grid-cols-3">
                    <!-- Doctor Image -->
                    <div class="md:col-span-1">
                        @if($doctor->image)
                        <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                            <i class="fas fa-user-md text-white text-9xl"></i>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Doctor Info -->
                    <div class="md:col-span-2 p-8">
                        <h2 class="text-3xl font-bold mb-4">{{ $doctor->name }}</h2>
                        <p class="text-xl text-blue-600 font-semibold mb-6">{{ $doctor->specialization }}</p>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex items-center">
                                <i class="fas fa-graduation-cap text-blue-600 w-6 mr-3"></i>
                                <span class="text-gray-700">{{ $doctor->qualification }}</span>
                            </div>
                            
                            <div class="flex items-center">
                                <i class="fas fa-briefcase text-blue-600 w-6 mr-3"></i>
                                <span class="text-gray-700">{{ $doctor->experience_years }}+ Years of Experience</span>
                            </div>
                            
                            @if($doctor->email)
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-blue-600 w-6 mr-3"></i>
                                <a href="mailto:{{ $doctor->email }}" class="text-gray-700 hover:text-blue-600">{{ $doctor->email }}</a>
                            </div>
                            @endif
                            
                            @if($doctor->phone)
                            <div class="flex items-center">
                                <i class="fas fa-phone text-blue-600 w-6 mr-3"></i>
                                <a href="tel:{{ $doctor->phone }}" class="text-gray-700 hover:text-blue-600">{{ $doctor->phone }}</a>
                            </div>
                            @endif
                        </div>
                        
                        @if($doctor->bio)
                        <div class="mb-6">
                            <h3 class="text-xl font-bold mb-3">About</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $doctor->bio }}</p>
                        </div>
                        @endif
                        
                        <a href="{{ route('frontend.appointment') }}?doctor={{ $doctor->id }}" class="bg-blue-600 text-white px-8 py-4 rounded-lg font-bold hover:bg-blue-700 transition inline-block">
                            <i class="fas fa-calendar-check mr-2"></i>Book Appointment
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
