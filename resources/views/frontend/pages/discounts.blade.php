@extends('frontend.layouts.frontend')

@section('meta_title', 'Special Discounts & Offers - BrightSmile Dental Clinic')
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
            @forelse($discounts as $discount)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index * 100) }}">
                <div class="card h-100 border-0 shadow-lg discount-card">
                    <div class="card-header text-white text-center py-4" style="background-color: {{ $discount->color }};">
                        <div class="discount-badge mb-3">
                            @if($discount->discount_percentage == 100)
                                <span class="display-4 fw-bold">FREE</span>
                            @else
                                <span class="display-4 fw-bold">{{ $discount->discount_percentage }}%</span>
                                <span class="h5 d-block">OFF</span>
                            @endif
                        </div>
                        <h4 class="fw-bold mb-0" style="color: white;">{{ $discount->title }}</h4>
                    </div>
                    <div class="card-body p-4">
                        @if($discount->benefits && count($discount->benefits) > 0)
                        <ul class="list-unstyled mb-4">
                            @foreach($discount->benefits as $benefit)
                            <li class="mb-3" style="color: {{ $discount->color }};">
                                <i class="fas fa-check me-2" style="color: {{ $discount->color }};"></i>
                                {{ $benefit }}
                            </li>
                            @endforeach
                        </ul>
                        @endif
                        
                        @if($discount->description)
                        <p class="text-muted small mb-4">{{ $discount->description }}</p>
                        @endif
                        
                        <a href="{{ $discount->button_link ?? route('appointment.create') }}" class="w-100 rounded-pill" style="background-color: {{ $discount->color }}; color: white; text-decoration: none; display: inline-block; padding: 10px; text-align: center; border: none; cursor: pointer;">
                            <i class="fas fa-calendar-check me-2"></i>{{ $discount->button_label }}
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <p class="text-muted mb-0">No discounts available at the moment.</p>
                </div>
            </div>
            @endforelse
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
