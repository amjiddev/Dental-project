@extends('frontend.layouts.frontend')

@section('meta_title', $service['title'] . ' - Manji Dental')
@section('meta_description', $service['description'])

@section('frontend-content')

<!-- Page Header -->
<section class="bg-gradient-blue text-white py-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-white-50 mb-3">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-white">Services</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ $service['title'] }}</li>
                    </ol>
                </nav>
                <h1 class="display-4 fw-bold mb-3 text-white">{{ $service['title'] }}</h1>
                <p class="lead mb-0">{{ $service['description'] }}</p>
            </div>
            <div class="col-lg-4 text-center" data-aos="fade-left">
                <div class="bg-white bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" 
                     style="width: 150px; height: 150px;">
                    <i class="{{ $service['icon'] }} text-white" style="font-size: 4rem;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Description -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up">
                <div class="card border-0 shadow-sm p-4 mb-5">
                    <div class="card-body">
                        <h2 class="h3 fw-bold mb-4 text-primary">About This Service</h2>
                        <p class="text-muted mb-4" style="font-size: 1.1rem; line-height: 1.8;">
                            {{ $service['description'] }} Our experienced team uses the latest technology and techniques to ensure the best possible outcomes for our patients. We prioritize your comfort and satisfaction throughout the entire treatment process.
                        </p>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-light-blue rounded-circle p-3">
                                            <i class="fas fa-check text-primary fa-lg"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">Expert Care</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-light-blue rounded-circle p-3">
                                            <i class="fas fa-check text-primary fa-lg"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">Modern Equipment</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-light-blue rounded-circle p-3">
                                            <i class="fas fa-check text-primary fa-lg"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">Affordable Pricing</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Treatments -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold mb-3" style="font-family: var(--font-heading); color: var(--primary-blue-dark);">
                Our Treatments
            </h2>
            <p class="text-muted lead">Comprehensive solutions tailored to your needs</p>
        </div>

        <div class="row g-4">
            @foreach($service['treatments'] as $index => $treatment)
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="card h-100 border-0 shadow-sm treatment-card">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src="{{ $treatment['image'] }}" 
                                 class="img-fluid h-100 w-100" 
                                 alt="{{ $treatment['name'] }}"
                                 style="object-fit: cover; border-radius: 12px 0 0 12px;">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-3">{{ $treatment['name'] }}</h5>
                                <p class="card-text text-muted mb-3">{{ $treatment['description'] }}</p>
                                <a href="{{ route('appointment.create') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                                    <i class="fas fa-calendar-check me-2"></i>Book Now
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
                <h2 class="h2 fw-bold mb-3 text-white">Ready to Get Started?</h2>
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
.treatment-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px !important;
    overflow: hidden;
}

.treatment-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255, 255, 255, 0.5);
}
</style>
@endpush

@push('frontend-scripts')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        offset: 100
    });
</script>
@endpush
