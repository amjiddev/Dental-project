@extends('frontend.layouts.frontend')

@section('meta_title', 'About Us - Dental Clinic')
@section('meta_description', 'Learn about our dental clinic, our mission, and our experienced team of dentists.')

@section('frontend-content')

<!-- Page Header -->
<section class="bg-gradient-blue text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold mb-3 text-white">About Us</h1>
                <p class="lead mb-0">Your trusted partner for comprehensive dental care</p>
            </div>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h2 class="section-title">Welcome to Our Dental Clinic</h2>
                <p class="lead text-muted mb-4">
                    Providing quality dental care with a focus on patient comfort and satisfaction since 2010.
                </p>
                <p class="mb-4">
                    At our dental clinic, we believe that everyone deserves a healthy, beautiful smile. Our team of experienced dentists and staff are dedicated to providing the highest quality dental care in a comfortable and welcoming environment.
                </p>
                <p class="mb-4">
                    We use the latest technology and techniques to ensure that our patients receive the best possible care. From routine cleanings to complex procedures, we're here to help you achieve and maintain optimal oral health.
                </p>
                <div class="row g-4 mt-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-light-blue rounded-circle p-3">
                                    <i class="fas fa-check text-primary fa-lg"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="h6 mb-0">Experienced Team</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-light-blue rounded-circle p-3">
                                    <i class="fas fa-check text-primary fa-lg"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="h6 mb-0">Modern Equipment</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-light-blue rounded-circle p-3">
                                    <i class="fas fa-check text-primary fa-lg"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="h6 mb-0">Patient Comfort</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-light-blue rounded-circle p-3">
                                    <i class="fas fa-check text-primary fa-lg"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="h6 mb-0">Affordable Pricing</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=800&h=600&fit=crop" 
                     alt="Dental Clinic" 
                     class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-5 bg-light-blue">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="bg-gradient-blue rounded-circle d-inline-flex p-4">
                                <i class="fas fa-bullseye text-white fa-2x"></i>
                            </div>
                        </div>
                        <h3 class="h4 text-center mb-3">Our Mission</h3>
                        <p class="text-muted text-center">
                            To provide exceptional dental care that improves the oral health and overall well-being of our patients. We strive to create a comfortable, caring environment where patients feel valued and respected.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="bg-gradient-blue rounded-circle d-inline-flex p-4">
                                <i class="fas fa-eye text-white fa-2x"></i>
                            </div>
                        </div>
                        <h3 class="h4 text-center mb-3">Our Vision</h3>
                        <p class="text-muted text-center">
                            To be the leading dental clinic in our community, known for our commitment to excellence, innovation, and patient satisfaction. We aim to set the standard for quality dental care.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Team -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Meet Our Team</h2>
            <p class="section-subtitle">Experienced professionals dedicated to your dental health</p>
        </div>

        <div class="row g-4">
            @forelse($doctors as $doctor)
            <div class="col-lg-3 col-md-6">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            @if($doctor->image)
                            <img src="{{ asset($doctor->image) }}" 
                                 alt="{{ $doctor->name }}" 
                                 class="rounded-circle img-fluid" 
                                 style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                            <div class="rounded-circle bg-gradient-blue d-inline-flex align-items-center justify-content-center text-white" 
                                 style="width: 120px; height: 120px; font-size: 3rem; font-weight: 700;">
                                {{ substr($doctor->name, 0, 1) }}
                            </div>
                            @endif
                        </div>
                        <h5 class="card-title mb-1">{{ $doctor->name }}</h5>
                        <p class="text-primary mb-2">{{ $doctor->specialization }}</p>
                        @if($doctor->qualification)
                        <p class="text-muted small mb-3">{{ $doctor->qualification }}</p>
                        @endif
                        @if($doctor->experience_years)
                        <p class="text-muted small">
                            <i class="fas fa-award me-1"></i>
                            {{ $doctor->experience_years }} years experience
                        </p>
                        @endif
                        <a href="{{ route('appointment.create') }}" class="btn btn-outline-primary btn-sm">
                            Book Appointment
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No doctors available at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-5 bg-light-blue">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Why Choose Us</h2>
            <p class="section-subtitle">What makes us different from other dental clinics</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-user-md fa-3x text-primary"></i>
                        </div>
                        <h5 class="card-title">Expert Dentists</h5>
                        <p class="card-text text-muted">
                            Our team consists of highly qualified and experienced dentists who are passionate about dental care.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-laptop-medical fa-3x text-primary"></i>
                        </div>
                        <h5 class="card-title">Advanced Technology</h5>
                        <p class="card-text text-muted">
                            We use the latest dental technology and equipment to provide the best possible care.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-heart fa-3x text-primary"></i>
                        </div>
                        <h5 class="card-title">Patient-Centered Care</h5>
                        <p class="card-text text-muted">
                            Your comfort and satisfaction are our top priorities. We listen to your concerns and needs.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-shield-alt fa-3x text-primary"></i>
                        </div>
                        <h5 class="card-title">Safe & Hygienic</h5>
                        <p class="card-text text-muted">
                            We maintain the highest standards of cleanliness and follow strict sterilization protocols.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-dollar-sign fa-3x text-primary"></i>
                        </div>
                        <h5 class="card-title">Affordable Pricing</h5>
                        <p class="card-text text-muted">
                            Quality dental care doesn't have to be expensive. We offer competitive pricing and payment plans.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-clock fa-3x text-primary"></i>
                        </div>
                        <h5 class="card-title">Flexible Hours</h5>
                        <p class="card-text text-muted">
                            We offer convenient appointment times to fit your busy schedule, including Saturdays.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5">
    <div class="container">
        <div class="card bg-gradient-blue text-white border-0 shadow">
            <div class="card-body p-5 text-center">
                <h3 class="h2 mb-3 text-white">Ready to Get Started?</h3>
                <p class="lead mb-4">Book your appointment today and experience the difference</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('appointment.create') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-calendar me-2"></i>
                        Book Appointment
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-phone me-2"></i>
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
