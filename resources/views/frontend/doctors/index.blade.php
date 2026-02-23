@extends('frontend.layouts.frontend')

@section('title', 'Our Doctors - Dental Clinic')
@section('meta_description', 'Meet our team of experienced dental professionals dedicated to your oral health.')

@section('content')

<!-- Page Header -->
<section class="dental-blue text-white py-16">
    <div class="container mx-auto px-4">
        <div class="text-center" data-aos="fade-up">
            <h1 class="text-5xl font-bold mb-4">Our Expert Doctors</h1>
            <p class="text-xl text-blue-100">Experienced professionals dedicated to your dental health</p>
        </div>
    </div>
</section>

<!-- Doctors Grid -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($doctors as $doctor)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="relative">
                    @if($doctor->image)
                    <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}" class="w-full h-80 object-cover">
                    @else
                    <div class="w-full h-80 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                        <i class="fas fa-user-md text-white text-9xl"></i>
                    </div>
                    @endif
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                        <h3 class="text-2xl font-bold text-white mb-1">{{ $doctor->name }}</h3>
                        <p class="text-blue-200 font-semibold">{{ $doctor->specialization }}</p>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-graduation-cap text-blue-600 mr-2"></i>
                        <span class="text-gray-600">{{ $doctor->qualification }}</span>
                    </div>
                    
                    <div class="flex items-center mb-4">
                        <i class="fas fa-briefcase text-blue-600 mr-2"></i>
                        <span class="text-gray-600">{{ $doctor->experience_years }}+ Years Experience</span>
                    </div>
                    
                    @if($doctor->bio)
                    <p class="text-gray-600 mb-4">{{ Str::limit($doctor->bio, 120) }}</p>
                    @endif
                    
                    <div class="flex gap-3">
                        <a href="{{ route('frontend.doctors.show', $doctor->id) }}" class="flex-1 bg-blue-600 text-white px-4 py-3 rounded-lg font-semibold hover:bg-blue-700 transition text-center">
                            View Profile
                        </a>
                        <a href="{{ route('frontend.appointment') }}?doctor={{ $doctor->id }}" class="flex-1 border-2 border-blue-600 text-blue-600 px-4 py-3 rounded-lg font-semibold hover:bg-blue-600 hover:text-white transition text-center">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-12 text-center text-white" data-aos="fade-up">
            <h2 class="text-3xl font-bold mb-4">Ready to Meet Our Team?</h2>
            <p class="text-xl mb-8 text-blue-100">Book your appointment and experience quality dental care</p>
            <a href="{{ route('frontend.appointment') }}" class="bg-white text-blue-600 px-10 py-4 rounded-full font-bold hover:bg-gray-100 transition inline-block">
                <i class="fas fa-calendar-check mr-2"></i>Book Appointment Now
            </a>
        </div>
    </div>
</section>

@endsection
