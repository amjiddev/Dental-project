@extends('frontend.layouts.frontend')

@section('meta_title', 'Our Team - Manji Dental')
@section('meta_description', 'Meet our team of experienced dental professionals dedicated to your oral health.')

@section('frontend-content')

<!-- Page Header -->
<section class="bg-gradient-blue text-white py-5">
    <div class="container py-4">
        <div class="text-center" data-aos="fade-up">
            <h1 class="display-4 fw-bold mb-3 text-white">Our Expert Team</h1>
            <p class="lead mb-0">Experienced professionals dedicated to your dental health</p>
        </div>
    </div>
</section>

<!-- Lead Surgeon -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold mb-3" style="font-family: var(--font-heading); color: var(--primary-blue-dark);">
                Meet Our Lead Dental Surgeon
            </h2>
            <p class="text-muted lead">Expert care from experienced professionals</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up">
                <div class="card border-0 shadow-lg">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <div class="bg-gradient-blue h-100 d-flex align-items-center justify-content-center" style="min-height: 400px;">
                                <i class="fas fa-user-md text-white" style="font-size: 8rem;"></i>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-5">
                                <h3 class="fw-bold mb-2" style="font-size: 2rem;">Dr. Hafsa Qasmi</h3>
                                <p class="text-primary mb-3 fw-semibold fs-5">Head Of Department & Assistant Professor</p>
                                <p class="text-muted small mb-3">MHPE (AKU), BDS (FJDC), CHPE(UoL), Citi Certified (USA), C. Implant (PAID) & C. Aesthetics (PARA)</p>
                                <p class="text-muted mb-4" style="line-height: 1.8;">
                                    Dr. Hafsa Qasmi brings years of expertise and a compassionate approach to dental and aesthetic care. She is dedicated to creating healthy, confident smiles while ensuring every patient feels comfortable and cared for. Her passion for excellence and attention to detail make her a trusted leader in her field.
                                </p>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('appointment.create') }}" class="btn btn-primary px-4 rounded-pill">
                                        <i class="fas fa-calendar-check me-2"></i>Book Appointment
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Members -->
@if($doctors->count() > 1)
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold mb-3" style="font-family: var(--font-heading); color: var(--primary-blue-dark);">
                Our Dental Specialists
            </h2>
            <p class="text-muted lead">Highly qualified professionals in various specialties</p>
        </div>

        <div class="row g-4">
            @foreach($doctors->skip(1) as $index => $doctor)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="card h-100 border-0 shadow-sm team-card">
                    <div class="position-relative">
                        @if($doctor->image)
                        <img src="{{ asset($doctor->image) }}" alt="{{ $doctor->name }}" class="card-img-top" style="height: 350px; object-fit: cover;">
                        @else
                        <div class="card-img-top bg-gradient-blue d-flex align-items-center justify-content-center" style="height: 350px;">
                            <i class="fas fa-user-md text-white" style="font-size: 5rem;"></i>
                        </div>
                        @endif
                        <div class="position-absolute bottom-0 start-0 end-0 bg-gradient-to-t p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                            <h5 class="text-white fw-bold mb-1">{{ $doctor->name }}</h5>
                            <p class="text-white-50 mb-0">{{ $doctor->specialization }}</p>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        @if($doctor->qualification)
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-graduation-cap text-primary me-2"></i>
                            <span class="text-muted small">{{ $doctor->qualification }}</span>
                        </div>
                        @endif
                        
                        @if($doctor->experience_years)
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-briefcase text-primary me-2"></i>
                            <span class="text-muted small">{{ $doctor->experience_years }}+ Years Experience</span>
                        </div>
                        @endif
                        
                        @if($doctor->bio)
                        <p class="text-muted small mb-4">{{ Str::limit($doctor->bio, 100) }}</p>
                        @endif
                        
                        <a href="{{ route('appointment.create') }}" class="btn btn-outline-primary w-100 rounded-pill">
                            <i class="fas fa-calendar-check me-2"></i>Book Appointment
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-5 bg-gradient-blue text-white">
    <div class="container py-4">
        <div class="row align-items-center" data-aos="fade-up">
            <div class="col-lg-8 text-center text-lg-start mb-4 mb-lg-0">
                <h2 class="h2 fw-bold mb-3 text-white">Ready to Meet Our Team?</h2>
                <p class="lead mb-0">Book your appointment and experience quality dental care</p>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <a href="{{ route('appointment.create') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill">
                    <i class="fas fa-calendar-check me-2"></i>Book Now
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('frontend-styles')
<style>
.team-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px !important;
    overflow: hidden;
}

.team-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
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
