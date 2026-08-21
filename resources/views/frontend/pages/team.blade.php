@extends('frontend.layouts.frontend')

@section('meta_title', 'Our Team - BrightSmile Dental Clinic')
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

<!-- Lead Doctor Detail Section -->
@if($leadDoctor)
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="row g-5">
            <!-- Doctor Image and Info -->
            <div class="col-lg-4" data-aos="fade-right">
                <div class="card border-0 shadow-lg position-relative">
                    @if($leadDoctor->image)
                    <img src="{{ asset($leadDoctor->image) }}" alt="Dr. {{ $leadDoctor->name }}" class="card-img-top" style="height: 400px; object-fit: cover;">
                    @else
                    <div class="bg-gradient-blue d-flex align-items-center justify-content-center" style="height: 400px;">
                        <i class="fas fa-user-md text-white" style="font-size: 8rem;"></i>
                    </div>
                    @endif
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge bg-warning">Lead Doctor</span>
                    </div>
                    <div class="card-body p-4">
                        @if($leadDoctor->qualification)
                        <div class="mb-3">
                            <p class="text-muted mb-1"><strong>Qualification:</strong></p>
                            <p class="text-primary small mb-0">{{ $leadDoctor->qualification }}</p>
                        </div>
                        @endif
                        
                        @if($leadDoctor->experience_years)
                        <div class="mb-3">
                            <p class="text-muted mb-1"><strong>Experience:</strong></p>
                            <p class="mb-0">{{ $leadDoctor->experience_years }} Years</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Doctor Bio -->
            <div class="col-lg-8" data-aos="fade-left">
                <div>
                    <h2 class="fw-bold mb-4" style="color: var(--primary-blue-dark);">About Dr. {{ $leadDoctor->name }}</h2>
                    
                    @if($leadDoctor->qualification)
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Qualifications</h5>
                        <p class="text-muted" style="line-height: 1.8;">{{ $leadDoctor->qualification }}</p>
                    </div>
                    @endif

                    @if($leadDoctor->bio)
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Biography</h5>
                        <p class="text-muted" style="line-height: 1.8;">{{ nl2br(e($leadDoctor->bio)) }}</p>
                    </div>
                    @endif

                    <a href="{{ route('appointment.create') }}" class="btn btn-primary btn-lg px-5 rounded-pill mt-4">
                        <i class="fas fa-calendar-check me-2"></i>Book Appointment
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- All Doctors Section -->
@if($doctors->count() > 0)
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3" style="font-family: var(--font-heading); color: var(--primary-blue-dark);">
                Our Dental Specialists
            </h2>
            <p class="text-muted lead">Highly qualified professionals in various specialties</p>
        </div>

        <div class="row g-4">
            @foreach($doctors as $index => $doctor)
                @if($doctor->id !== $leadDoctor->id)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="card border-0 shadow doctor-card h-100 position-relative">
                        @if($doctor->image)
                        <img src="{{ asset($doctor->image) }}" alt="Dr. {{ $doctor->name }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                        @else
                        <div class="bg-gradient-blue d-flex align-items-center justify-content-center" style="height: 250px;">
                            <i class="fas fa-user-md text-white" style="font-size: 4rem;"></i>
                        </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-1">Dr. {{ $doctor->name }}</h5>
                            <p class="text-primary small fw-semibold mb-3">{{ $doctor->specialization }}</p>
                            @if($doctor->experience_years)
                            <p class="text-muted small mb-3"><i class="fas fa-briefcase me-1"></i>{{ $doctor->experience_years }} Years Experience</p>
                            @endif
                            <a href="{{ route('doctor.show', $doctor->id) }}" class="btn btn-outline-primary w-100 btn-sm">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>
                @endif
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
.doctor-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px !important;
    overflow: hidden;
}

.doctor-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15) !important;
}

.bg-gradient-blue {
    background: linear-gradient(135deg, #0066FF 0%, #0047BB 100%);
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
