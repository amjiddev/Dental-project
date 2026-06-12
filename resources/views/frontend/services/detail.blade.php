@extends('frontend.layouts.frontend')

@section('meta_title', $service['title'] . ' - Manji Dental & Aesthetic Centre')
@section('meta_description', $service['description'])

@section('frontend-content')

<!-- Hero Section with Service Title -->
<section class="service-hero" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); min-height: 60vh; display: flex; align-items: center; position: relative; overflow: hidden;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb text-white-50">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('services.index') }}" class="text-white">Services</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ $service['title'] }}</li>
                    </ol>
                </nav>
                <h1 class="display-3 fw-bold text-white mb-4" style="font-family: var(--font-heading); line-height: 1.2;">
                    {{ $service['title'] }}
                </h1>
                <p class="lead text-white mb-5" style="font-size: 1.2rem; line-height: 1.8; max-width: 600px;">
                    {{ $service['description'] }}
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('appointment.create') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill">
                        <i class="fas fa-calendar-check me-2"></i>
                        Book Appointment
                    </a>
                    <a href="{{ route('services.index') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">
                        <i class="fas fa-arrow-left me-2"></i>
                        Back to Services
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center" data-aos="fade-left">
                <div class="service-icon-large">
                    <i class="{{ $service['icon'] }} text-white" style="font-size: 12rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Overview Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up">
                <div class="card border-0 shadow-lg p-5 mb-5" style="border-radius: 15px;">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center mb-4 mb-md-0">
                            <div class="service-icon-box" style="width: 120px; height: 120px; margin: 0 auto; background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                                <i class="{{ $service['icon'] }} text-white" style="font-size: 4rem;"></i>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h2 class="h3 fw-bold mb-3" style="color: var(--primary-blue-dark);">About This Service</h2>
                            <p class="text-muted mb-4" style="font-size: 1.1rem; line-height: 1.8;">
                                {{ $service['description'] }} Our experienced team uses the latest technology and techniques to ensure the best possible outcomes for our patients. We prioritize your comfort and satisfaction throughout the entire treatment process.
                            </p>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle text-success me-2" style="font-size: 1.5rem;"></i>
                                        <span class="fw-semibold">Expert Care</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle text-success me-2" style="font-size: 1.5rem;"></i>
                                        <span class="fw-semibold">Modern Equipment</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle text-success me-2" style="font-size: 1.5rem;"></i>
                                        <span class="fw-semibold">Affordable Pricing</span>
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

<!-- Treatment Options Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3" style="font-family: var(--font-heading); color: var(--primary-blue-dark);">
                Treatment Options
            </h2>
            <p class="text-muted lead">Comprehensive solutions tailored to your needs</p>
        </div>

        <div class="row g-4">
            @foreach($service['treatments'] as $index => $treatment)
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="card h-100 border-0 shadow-sm treatment-card" style="border-radius: 15px; overflow: hidden; transition: all 0.3s ease;">
                    <div class="row g-0 h-100">
                        <div class="col-md-5">
                            <img src="{{ $treatment['image'] }}" 
                                 class="img-fluid h-100 w-100" 
                                 alt="{{ $treatment['name'] }}"
                                 style="object-fit: cover;">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-4 d-flex flex-column justify-content-between h-100">
                                <div>
                                    <h5 class="card-title fw-bold mb-3" style="color: var(--primary-blue-dark); font-size: 1.2rem;">
                                        {{ $treatment['name'] }}
                                    </h5>
                                    <p class="card-text text-muted mb-3" style="font-size: 0.95rem; line-height: 1.6;">
                                        {{ $treatment['description'] }}
                                    </p>
                                </div>
                                <a href="{{ route('appointment.create') }}" class="btn btn-primary btn-sm rounded-pill px-4 align-self-start">
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

<!-- Why Choose Us Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3" style="font-family: var(--font-heading); color: var(--primary-blue-dark);">
                Why Choose Our {{ $service['title'] }} Service?
            </h2>
            <p class="text-muted lead">Excellence in every aspect of care</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center p-4 feature-box" style="border-radius: 15px; background: #f8f9fa; transition: all 0.3s ease;">
                    <div class="mb-4">
                        <div style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user-md text-white fa-2x"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3" style="color: var(--primary-blue-dark);">Expert Specialists</h5>
                    <p class="text-muted mb-0">Highly qualified professionals with extensive experience</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center p-4 feature-box" style="border-radius: 15px; background: #f8f9fa; transition: all 0.3s ease;">
                    <div class="mb-4">
                        <div style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-microscope text-white fa-2x"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3" style="color: var(--primary-blue-dark);">Advanced Technology</h5>
                    <p class="text-muted mb-0">Latest equipment and cutting-edge techniques</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center p-4 feature-box" style="border-radius: 15px; background: #f8f9fa; transition: all 0.3s ease;">
                    <div class="mb-4">
                        <div style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-heart text-white fa-2x"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3" style="color: var(--primary-blue-dark);">Patient Comfort</h5>
                    <p class="text-muted mb-0">Your comfort and satisfaction is our priority</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="text-center p-4 feature-box" style="border-radius: 15px; background: #f8f9fa; transition: all 0.3s ease;">
                    <div class="mb-4">
                        <div style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-shield-alt text-white fa-2x"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3" style="color: var(--primary-blue-dark);">Safe & Hygienic</h5>
                    <p class="text-muted mb-0">Highest safety and hygiene standards maintained</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3" style="font-family: var(--font-heading); color: var(--primary-blue-dark);">
                Frequently Asked Questions
            </h2>
            <p class="text-muted lead">Common questions about our services</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 mb-3" style="border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                How long does the treatment take?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                The duration of treatment varies depending on the specific procedure and individual patient needs. During your consultation, our specialists will provide you with a detailed timeline.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3" style="border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                Is the treatment painful?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                We use advanced anesthesia and pain management techniques to ensure your comfort throughout the procedure. Most patients report minimal to no discomfort.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3" style="border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                What is the recovery time?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Recovery time depends on the type of treatment. We'll provide detailed post-treatment care instructions to ensure optimal healing and results.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0" style="border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                                What are the costs involved?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Costs vary based on the specific treatment and individual needs. We offer transparent pricing and flexible payment options. Contact us for a detailed quote.
                            </div>
                        </div>
                    </div>
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
                <h2 class="display-6 fw-bold mb-3 text-white">Ready to Get Started?</h2>
                <p class="lead mb-0">Book your appointment today and experience quality dental care from our expert team</p>
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
.treatment-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
}

.feature-box:hover {
    transform: translateY(-5px);
    background: white !important;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1) !important;
}

.accordion-button:not(.collapsed) {
    background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
    color: white;
}

.accordion-button:focus {
    border-color: #1e40af;
    box-shadow: 0 0 0 0.25rem rgba(30, 64, 175, 0.25);
}

.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255, 255, 255, 0.5);
}

.breadcrumb-item a {
    text-decoration: none;
    transition: all 0.3s ease;
}

.breadcrumb-item a:hover {
    text-decoration: underline;
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
