@extends('frontend.layouts.frontend')

@section('meta_title', 'Our Services - Manji Dental & Aesthetic Centre')
@section('meta_description', 'Explore our comprehensive range of dental and aesthetic services provided by expert professionals.')

@section('frontend-content')

<!-- Page Header -->
<section class="bg-gradient-blue text-white py-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-white-50 mb-3">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Services</li>
                    </ol>
                </nav>
                <h1 class="display-4 fw-bold mb-3 text-white">Our Services</h1>
                <p class="lead mb-0">Comprehensive dental and aesthetic care solutions tailored to your needs</p>
            </div>
            <div class="col-lg-4 text-center" data-aos="fade-left">
                <div class="bg-white bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" 
                     style="width: 150px; height: 150px;">
                    <i class="fas fa-tooth text-white" style="font-size: 4rem;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            @foreach($services as $index => $service)
            <div class="col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="card h-100 border-0 shadow-sm service-card">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src="{{ asset($service['image']) }}" 
                                 class="img-fluid h-100 w-100" 
                                 alt="{{ $service['title'] }}"
                                 style="object-fit: cover; border-radius: 12px 0 0 12px;">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <i class="{{ $service['icon'] }} text-primary" style="font-size: 2rem;"></i>
                                </div>
                                <h5 class="card-title fw-bold mb-3">{{ $service['title'] }}</h5>
                                <p class="card-text text-muted mb-4">{{ $service['description'] }}</p>
                                <a href="{{ route($service['route']) }}" class="btn btn-primary rounded-pill px-4">
                                    <i class="fas fa-arrow-right me-2"></i>Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-gradient-blue text-white">
    <div class="container py-4">
        <div class="row align-items-center" data-aos="fade-up">
            <div class="col-lg-8 text-center text-lg-start mb-4 mb-lg-0">
                <h2 class="h2 fw-bold mb-3 text-white">Ready to Transform Your Smile?</h2>
                <p class="lead mb-0">Book your appointment today and experience quality dental care</p>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <a href="{{ route('appointment.create') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill">
                    <i class="fas fa-calendar-check me-2"></i>
                    Book Appointment
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('frontend-styles')
<style>
.service-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px !important;
    overflow: hidden;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
}

.service-card .btn {
    transition: all 0.3s ease;
}

.service-card:hover .btn {
    transform: translateX(5px);
}
</style>
@endpush
