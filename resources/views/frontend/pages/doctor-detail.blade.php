@extends('frontend.layouts.frontend')

@section('meta_title', 'Dr. ' . $doctor->name . ' - BrightSmile Dental Clinic')
@section('meta_description', $doctor->specialization . ' - ' . substr($doctor->bio, 0, 150))

@section('frontend-content')

<!-- Page Header -->
<section class="bg-gradient-blue text-white py-5">
    <div class="container py-4">
        <div class="text-center" data-aos="fade-up">
            <h1 class="display-4 fw-bold mb-3 text-white">Dr. {{ $doctor->name }}</h1>
            <p class="lead mb-0">{{ $doctor->specialization }}</p>
        </div>
    </div>
</section>

<!-- Doctor Detail Section -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Doctor Image and Info -->
            <div class="col-lg-4" data-aos="fade-right">
                <div class="card border-0 shadow-lg position-relative">
                    @if($doctor->image)
                    <img src="{{ asset($doctor->image) }}" alt="Dr. {{ $doctor->name }}" class="card-img-top" style="height: 400px; object-fit: cover;">
                    @else
                    <div class="bg-gradient-blue d-flex align-items-center justify-content-center" style="height: 400px;">
                        <span class="text-white" style="font-size: 8rem;">{{ substr($doctor->name, 0, 1) }}</span>
                    </div>
                    @endif
                    @if($doctor->is_lead_doctor)
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge bg-warning">Lead Doctor</span>
                    </div>
                    @endif
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <p class="text-primary fw-semibold mb-2">{{ $doctor->specialization }}</p>
                        </div>
                        
                        @if($doctor->experience_years)
                        <div class="mb-3">
                            <p class="text-muted mb-1"><strong>Experience:</strong></p>
                            <p class="mb-0">{{ $doctor->experience_years }} Years</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Doctor Bio -->
            <div class="col-lg-8" data-aos="fade-left">
                <div>
                    <h2 class="fw-bold mb-4" style="color: var(--primary-blue-dark);">About Dr. {{ $doctor->name }}</h2>
                    
                    @if($doctor->qualification)
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Qualifications</h5>
                        <p class="text-muted" style="line-height: 1.8;">{{ $doctor->qualification }}</p>
                    </div>
                    @endif

                    @if($doctor->bio)
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Biography</h5>
                        <p class="text-muted" style="line-height: 1.8;">{{ nl2br(e($doctor->bio)) }}</p>
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

<!-- Other Doctors Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3" style="font-family: var(--font-heading); color: var(--primary-blue-dark);">
                Our Dental Specialists
            </h2>
            <p class="text-muted lead">Highly qualified professionals in various specialties</p>
        </div>

        <div class="row g-4">
            <!-- Lead Doctor First -->
            @if($leadDoctor && $leadDoctor->id !== $doctor->id)
            <div class="col-lg-4 col-md-6" data-aos="fade-up">
                <div class="card border-0 shadow doctor-card h-100 position-relative">
                    @if($leadDoctor->image)
                    <img src="{{ asset($leadDoctor->image) }}" alt="Dr. {{ $leadDoctor->name }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                    @else
                    <div class="bg-gradient-blue d-flex align-items-center justify-content-center" style="height: 250px;">
                        <span class="text-white" style="font-size: 4rem;">{{ substr($leadDoctor->name, 0, 1) }}</span>
                    </div>
                    @endif
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge bg-warning">Lead Doctor</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-1">Dr. {{ $leadDoctor->name }}</h5>
                        <p class="text-primary small fw-semibold mb-3">{{ $leadDoctor->specialization }}</p>
                        @if($leadDoctor->experience_years)
                        <p class="text-muted small mb-3"><i class="fas fa-briefcase me-1"></i>{{ $leadDoctor->experience_years }} Years Experience</p>
                        @endif
                        <a href="{{ route('doctor.show', $leadDoctor->id) }}" class="btn btn-outline-primary w-100 btn-sm">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Other Doctors -->
            @foreach($doctors as $otherDoctor)
                @if($otherDoctor->id !== $doctor->id && $otherDoctor->id !== ($leadDoctor->id ?? null))
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index * 100) }}">
                    <div class="card border-0 shadow doctor-card h-100">
                        @if($otherDoctor->image)
                        <img src="{{ asset($otherDoctor->image) }}" alt="Dr. {{ $otherDoctor->name }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                        @else
                        <div class="bg-gradient-blue d-flex align-items-center justify-content-center" style="height: 250px;">
                            <span class="text-white" style="font-size: 4rem;">{{ substr($otherDoctor->name, 0, 1) }}</span>
                        </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-1">Dr. {{ $otherDoctor->name }}</h5>
                            <p class="text-primary small fw-semibold mb-3">{{ $otherDoctor->specialization }}</p>
                            @if($otherDoctor->experience_years)
                            <p class="text-muted small mb-3"><i class="fas fa-briefcase me-1"></i>{{ $otherDoctor->experience_years }} Years Experience</p>
                            @endif
                            <a href="{{ route('doctor.show', $otherDoctor->id) }}" class="btn btn-outline-primary w-100 btn-sm">
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
