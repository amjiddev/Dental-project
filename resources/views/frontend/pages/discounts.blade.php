@extends('frontend.layouts.frontend')

@section('meta_title', 'Special Discounts & Offers - Manji Dental')
@section('meta_description', 'Check out our special discounts and offers on dental treatments.')

@section('frontend-content')

<!-- Page Header -->
<section class="bg-gradient-blue text-white py-5">
    <div class="container py-4">
        <div class="text-center" data-aos="fade-up">
            <h1 class="display-4 fw-bold mb-3 text-white">Special Discounts & Offers</h1>
            <p class="lead mb-0">Save on quality dental care with our exclusive offers</p>
        </div>
    </div>
</section>

<!-- Discount Offers -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <!-- Discount 1 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-lg discount-card">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <div class="discount-badge mb-3">
                            <span class="display-4 fw-bold">20%</span>
                            <span class="h5 d-block">OFF</span>
                        </div>
                        <h4 class="fw-bold mb-0">New Patient Special</h4>
                    </div>
                    <div class="card-body p-4">
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3"><i class="fas fa-check text-primary me-2"></i>Comprehensive Dental Exam</li>
                            <li class="mb-3"><i class="fas fa-check text-primary me-2"></i>Full Mouth X-Rays</li>
                            <li class="mb-3"><i class="fas fa-check text-primary me-2"></i>Teeth Cleaning</li>
                            <li class="mb-3"><i class="fas fa-check text-primary me-2"></i>Consultation</li>
                        </ul>
                        <p class="text-muted small mb-4">Valid for first-time patients only. Cannot be combined with other offers.</p>
                        <a href="{{ route('appointment.create') }}" class="btn btn-primary w-100 rounded-pill">
                            <i class="fas fa-calendar-check me-2"></i>Book Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Discount 2 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-lg discount-card">
                    <div class="card-header bg-success text-white text-center py-4">
                        <div class="discount-badge mb-3">
                            <span class="display-4 fw-bold">15%</span>
                            <span class="h5 d-block">OFF</span>
                        </div>
                        <h4 class="fw-bold mb-0">Teeth Whitening</h4>
                    </div>
                    <div class="card-body p-4">
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3"><i class="fas fa-check text-success me-2"></i>Professional Whitening</li>
                            <li class="mb-3"><i class="fas fa-check text-success me-2"></i>Take-Home Kit Included</li>
                            <li class="mb-3"><i class="fas fa-check text-success me-2"></i>Follow-up Consultation</li>
                            <li class="mb-3"><i class="fas fa-check text-success me-2"></i>Guaranteed Results</li>
                        </ul>
                        <p class="text-muted small mb-4">Limited time offer. Book your appointment today!</p>
                        <a href="{{ route('appointment.create') }}" class="btn btn-success w-100 rounded-pill">
                            <i class="fas fa-calendar-check me-2"></i>Book Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Discount 3 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-lg discount-card">
                    <div class="card-header bg-info text-white text-center py-4">
                        <div class="discount-badge mb-3">
                            <span class="display-4 fw-bold">10%</span>
                            <span class="h5 d-block">OFF</span>
                        </div>
                        <h4 class="fw-bold mb-0">Family Package</h4>
                    </div>
                    <div class="card-body p-4">
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3"><i class="fas fa-check text-info me-2"></i>For 3+ Family Members</li>
                            <li class="mb-3"><i class="fas fa-check text-info me-2"></i>All Dental Services</li>
                            <li class="mb-3"><i class="fas fa-check text-info me-2"></i>Priority Scheduling</li>
                            <li class="mb-3"><i class="fas fa-check text-info me-2"></i>Free Consultations</li>
                        </ul>
                        <p class="text-muted small mb-4">Discount applies to all family members. Valid for 1 year.</p>
                        <a href="{{ route('appointment.create') }}" class="btn btn-info w-100 rounded-pill text-white">
                            <i class="fas fa-calendar-check me-2"></i>Book Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Discount 4 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-lg discount-card">
                    <div class="card-header bg-warning text-dark text-center py-4">
                        <div class="discount-badge mb-3">
                            <span class="display-4 fw-bold">25%</span>
                            <span class="h5 d-block">OFF</span>
                        </div>
                        <h4 class="fw-bold mb-0">Orthodontic Treatment</h4>
                    </div>
                    <div class="card-body p-4">
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3"><i class="fas fa-check text-warning me-2"></i>Braces or Aligners</li>
                            <li class="mb-3"><i class="fas fa-check text-warning me-2"></i>Free Initial Consultation</li>
                            <li class="mb-3"><i class="fas fa-check text-warning me-2"></i>Flexible Payment Plans</li>
                            <li class="mb-3"><i class="fas fa-check text-warning me-2"></i>Retainers Included</li>
                        </ul>
                        <p class="text-muted small mb-4">Special offer on complete orthodontic treatment packages.</p>
                        <a href="{{ route('appointment.create') }}" class="btn btn-warning w-100 rounded-pill">
                            <i class="fas fa-calendar-check me-2"></i>Book Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Discount 5 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-lg discount-card">
                    <div class="card-header bg-danger text-white text-center py-4">
                        <div class="discount-badge mb-3">
                            <span class="display-4 fw-bold">30%</span>
                            <span class="h5 d-block">OFF</span>
                        </div>
                        <h4 class="fw-bold mb-0">Dental Implants</h4>
                    </div>
                    <div class="card-body p-4">
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3"><i class="fas fa-check text-danger me-2"></i>Single or Multiple Implants</li>
                            <li class="mb-3"><i class="fas fa-check text-danger me-2"></i>Premium Quality Materials</li>
                            <li class="mb-3"><i class="fas fa-check text-danger me-2"></i>Lifetime Warranty</li>
                            <li class="mb-3"><i class="fas fa-check text-danger me-2"></i>Free Follow-ups</li>
                        </ul>
                        <p class="text-muted small mb-4">Limited slots available. Book early to secure your discount.</p>
                        <a href="{{ route('appointment.create') }}" class="btn btn-danger w-100 rounded-pill">
                            <i class="fas fa-calendar-check me-2"></i>Book Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Discount 6 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-lg discount-card">
                    <div class="card-header bg-dark text-white text-center py-4">
                        <div class="discount-badge mb-3">
                            <span class="display-4 fw-bold">FREE</span>
                            <span class="h5 d-block">Consultation</span>
                        </div>
                        <h4 class="fw-bold mb-0">Senior Citizens</h4>
                    </div>
                    <div class="card-body p-4">
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3"><i class="fas fa-check text-dark me-2"></i>Free Dental Checkup</li>
                            <li class="mb-3"><i class="fas fa-check text-dark me-2"></i>10% Off All Treatments</li>
                            <li class="mb-3"><i class="fas fa-check text-dark me-2"></i>Priority Appointments</li>
                            <li class="mb-3"><i class="fas fa-check text-dark me-2"></i>Special Care Plans</li>
                        </ul>
                        <p class="text-muted small mb-4">For patients 60 years and above. Valid ID required.</p>
                        <a href="{{ route('appointment.create') }}" class="btn btn-dark w-100 rounded-pill">
                            <i class="fas fa-calendar-check me-2"></i>Book Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Terms & Conditions -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="card border-0 shadow-sm p-4">
                    <h3 class="h4 fw-bold mb-4 text-primary">Terms & Conditions</h3>
                    <ul class="text-muted">
                        <li class="mb-2">All discounts are subject to availability and may be modified or discontinued at any time.</li>
                        <li class="mb-2">Discounts cannot be combined with other offers or promotions.</li>
                        <li class="mb-2">Valid ID and proof of eligibility may be required for certain discounts.</li>
                        <li class="mb-2">Discounts apply to treatment costs only and do not include lab fees or materials.</li>
                        <li class="mb-2">Appointments must be scheduled in advance to avail discounts.</li>
                        <li class="mb-2">Management reserves the right to modify terms and conditions without prior notice.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-gradient-blue text-white">
    <div class="container py-4">
        <div class="row align-items-center" data-aos="fade-up">
            <div class="col-lg-8 text-center text-lg-start mb-4 mb-lg-0">
                <h2 class="h2 fw-bold mb-3 text-white">Don't Miss Out on These Amazing Offers!</h2>
                <p class="lead mb-0">Book your appointment today and save on quality dental care</p>
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
.discount-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px !important;
    overflow: hidden;
}

.discount-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2) !important;
}

.discount-badge {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
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
