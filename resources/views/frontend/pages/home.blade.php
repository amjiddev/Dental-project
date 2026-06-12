@extends('frontend.layouts.frontend')

@section('meta_title', 'Manji Dental & Aesthetic Centre - Expert Dental and Aesthetic Care')
@section('meta_description', 'We bring together expert dental and aesthetic care with a passion for creating healthy, beautiful smiles & skins. Every treatment is tailored to your needs.')

@section('frontend-content')

<!-- Hero Section -->
<section class="hero-section position-relative" style="margin: 0; padding: 0;">
    <div class="hero-background" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); min-height: 100vh; display: flex; align-items: center;">
        <div class="container">
            <div class="row align-items-center" style="min-height: auto; padding: 40px 0;">
                <div class="col-lg-7 text-white" data-aos="fade-right">
                    <h1 class="display-2 fw-bold mb-4 text-white" style="font-family: var(--font-heading); line-height: 1.2;">
                        We bring together expert dental and aesthetic care
                    </h1>
                    <p class="lead mb-5" style="font-size: 1.2rem; line-height: 1.8; max-width: 600px;">
                        We bring together expert dental and aesthetic care with a passion for creating healthy, beautiful smiles & skins. Every treatment is tailored to your needs, ensuring comfort and results that last.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('appointment.create') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill">
                            <i class="fas fa-calendar-check me-2"></i>
                            Book Appointment
                        </a>
                        <a href="{{ route('services.operative') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">
                            <i class="fas fa-tooth me-2"></i>
                            Our Services
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=600&h=600&fit=crop" 
                         alt="Dental Care" 
                         class="img-fluid rounded-4 shadow-lg"
                         style="max-width: 100%; border-radius: 20px !important;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="stats-card p-3">
                    <div class="stats-icon mb-2">
                        <i class="fas fa-tooth text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h2 class="stats-number fw-bold mb-1" data-count="10">0</h2>
                    <p class="text-muted mb-0 fw-semibold small">Years of Expertise</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="stats-card p-3">
                    <div class="stats-icon mb-2">
                        <i class="fas fa-user-md text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h2 class="stats-number fw-bold mb-1" data-count="6">0</h2>
                    <p class="text-muted mb-0 fw-semibold small">Expert Doctors</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="stats-card p-3">
                    <div class="stats-icon mb-2">
                        <i class="fas fa-smile text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h2 class="stats-number fw-bold mb-1" data-count="2300">0</h2>
                    <p class="text-muted mb-0 fw-semibold small">Satisfied Patients</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="stats-card p-3">
                    <div class="stats-icon mb-2">
                        <i class="fas fa-award text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h2 class="stats-number fw-bold mb-1" data-count="500">0</h2>
                    <p class="text-muted mb-0 fw-semibold small">Successful Treatments</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=800&h=600&fit=crop" 
                     alt="Dental Clinic" 
                     class="img-fluid rounded-4 shadow-lg"
                     style="border-radius: 20px !important;">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="display-5 fw-bold mb-4" style="font-family: var(--font-heading); color: var(--primary-blue-dark);">
                    Creating Beauty Through Healthy Smiles
                </h2>
                <p class="text-muted mb-4" style="font-size: 1.1rem; line-height: 1.8;">
                    Welcome to Qasmi Dental & Aesthetic Centre, Lahore's trusted choice for dental and facial aesthetic care. We offer cosmetic and general dentistry, smile makeovers, and advanced facial treatments using modern technology and expert care.
                </p>
                <p class="text-muted mb-4" style="font-size: 1.1rem; line-height: 1.8;">
                    Our skilled team creates personalized plans for your comfort and safety. From routine checkups to whitening, veneers, implants, and facial rejuvenation, we provide lasting results in a modern, welcoming space.
                </p>
                <a href="{{ route('about') }}" class="btn btn-primary btn-lg px-5 rounded-pill">
                    Learn More About Us
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3" style="font-family: var(--font-heading); color: var(--primary-blue-dark);">
                Dental Services
            </h2>
            <p class="text-muted lead">Comprehensive dental care for your beautiful smile</p>
        </div>

        <div class="row g-4 mb-5">
            @php
            $serviceImages = [
                'Teeth Whitening' => 'frontend/images/teeth whitening.webp',
                'Dental Implants' => 'frontend/images/Dental Implants.jpg',
                'Root Canal Treatment' => 'frontend/images/Root Canal Treatment.webp',
                'Root Canal' => 'frontend/images/Root Canal Treatment.webp',
                'Orthodontics' => 'frontend/images/Orthodontics (Braces).jpg',
                'Braces' => 'frontend/images/Orthodontics (Braces).jpg',
                'Dental Crowns' => 'frontend/images/Dental Crowns.webp',
                'Crowns' => 'frontend/images/Dental Crowns.webp',
                'Teeth Cleaning' => 'frontend/images/teeth-cleaning.jfif',
                'Dental Cleaning' => 'frontend/images/teeth-cleaning.jfif',
                'Cleaning' => 'frontend/images/teeth-cleaning.jfif',
            ];
            @endphp
            @forelse($services->take(6) as $service)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card h-100 border-0 shadow-sm service-card">
                    @php
                    $imageToUse = null;
                    // Check if service name matches any key in serviceImages
                    foreach($serviceImages as $key => $imagePath) {
                        if(stripos($service->name, $key) !== false) {
                            $imageToUse = $imagePath;
                            break;
                        }
                    }
                    // If no match found, use service image or show icon
                    if(!$imageToUse && $service->image) {
                        $imageToUse = $service->image;
                    }
                    @endphp
                    
                    @if($imageToUse)
                    <img src="{{ asset($imageToUse) }}" class="card-img-top" alt="{{ $service->name }}" style="height: 280px; object-fit: cover;">
                    @else
                    <div class="card-img-top bg-gradient-blue d-flex align-items-center justify-content-center" style="height: 280px;">
                        <i class="{{ $service->icon ?? 'fas fa-tooth' }} fa-4x text-white"></i>
                    </div>
                    @endif
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-3" style="font-size: 1.3rem;">{{ $service->name }}</h5>
                        <p class="card-text text-muted mb-4">{{ $service->short_description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            @if($service->price)
                            <span class="text-primary fw-bold fs-5">Rs. {{ number_format($service->price, 0) }}</span>
                            @endif
                            <button type="button" class="btn btn-outline-primary rounded-pill px-4" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#serviceModal{{ $loop->index }}"
                                    data-service-name="{{ $service->name }}"
                                    data-service-description="{{ $service->short_description }}"
                                    data-service-price="{{ $service->price ?? 0 }}"
                                    data-service-image="{{ $imageToUse ? asset($imageToUse) : '' }}">
                                Learn More
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Service Modal -->
            <div class="modal fade" id="serviceModal{{ $loop->index }}" tabindex="-1" aria-labelledby="serviceModalLabel{{ $loop->index }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 700px;">
                    <div class="modal-content">
                        <div class="modal-header border-0 pb-2">
                            <h5 class="modal-title fw-bold" id="serviceModalLabel{{ $loop->index }}">{{ $service->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-3">
                            <div class="row g-3">
                                <div class="col-md-5">
                                    @if($imageToUse)
                                    <img src="{{ asset($imageToUse) }}" 
                                         class="img-fluid rounded-3 zoom-image" 
                                         alt="{{ $service->name }}" 
                                         style="width: 100%; height: 220px; object-fit: cover; cursor: zoom-in;"
                                         data-bs-toggle="modal" 
                                         data-bs-target="#imageModal{{ $loop->index }}"
                                         onclick="event.stopPropagation();">
                                    @else
                                    <div class="bg-gradient-blue d-flex align-items-center justify-content-center rounded-3" style="height: 220px;">
                                        <i class="{{ $service->icon ?? 'fas fa-tooth' }} fa-4x text-white"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-7">
                                    <p class="text-muted mb-3">{{ $service->short_description }}</p>
                                    
                                    <div class="mb-3">
                                        <h6 class="fw-bold mb-2">Benefits:</h6>
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Professional treatment</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Modern equipment</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Comfortable environment</li>
                                        </ul>
                                    </div>
                                    
                                    @if($service->price)
                                    <div class="alert alert-light border mb-0 py-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted">Starting Price:</span>
                                            <span class="text-primary fw-bold fs-5">Rs. {{ number_format($service->price, 0) }}</span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-2 pb-3">
                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                            <a href="{{ route('appointment.create') }}" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-calendar-check me-2"></i>Book Appointment
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Image Zoom Modal -->
            @if($imageToUse)
            <div class="modal fade" id="imageModal{{ $loop->index }}" tabindex="-1" aria-hidden="true" data-bs-backdrop="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-transparent border-0">
                        <div class="modal-body p-0 position-relative">
                            <button type="button" class="image-modal-close" data-bs-dismiss="modal" aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                            <img src="{{ asset($imageToUse) }}" class="img-fluid rounded-3" alt="{{ $service->name }}" style="width: 100%; max-height: 80vh; object-fit: contain;" onclick="document.getElementById('imageModal{{ $loop->index }}').querySelector('.image-modal-close').click();">
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @empty
            <!-- Default Services -->
            @php
            $defaultServices = [
                [
                    'name' => 'Teeth Whitening',
                    'description' => 'Professional whitening for a brighter smile',
                    'image' => 'frontend/images/teeth whitening.webp',
                    'price' => 350
                ],
                [
                    'name' => 'Dental Implants',
                    'description' => 'Permanent solution for missing teeth',
                    'image' => 'frontend/images/Dental Implants.jpg',
                    'price' => 2500
                ],
                [
                    'name' => 'Root Canal Treatment',
                    'description' => 'Pain-free root canal therapy',
                    'image' => 'frontend/images/Root Canal Treatment.webp',
                    'price' => 1200
                ],
                [
                    'name' => 'Orthodontics (Braces)',
                    'description' => 'Straighten your teeth with modern braces',
                    'image' => 'frontend/images/Orthodontics (Braces).jpg',
                    'price' => 3500
                ],
                [
                    'name' => 'Dental Crowns',
                    'description' => 'Restore damaged teeth with durable crowns',
                    'image' => 'frontend/images/Dental Crowns.webp',
                    'price' => 1500
                ],
                [
                    'name' => 'Teeth Cleaning',
                    'description' => 'Professional dental cleaning',
                    'image' => 'frontend/images/teeth-cleaning.jfif',
                    'price' => 80
                ]
            ];
            @endphp
            @foreach($defaultServices as $index => $service)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="card h-100 border-0 shadow-sm service-card">
                    <img src="{{ asset($service['image']) }}" class="card-img-top" alt="{{ $service['name'] }}" style="height: 280px; object-fit: cover;">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-3" style="font-size: 1.3rem;">{{ $service['name'] }}</h5>
                        <p class="card-text text-muted mb-4">{{ $service['description'] }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold fs-5">Rs. {{ number_format($service['price'], 0) }}</span>
                            <button type="button" class="btn btn-outline-primary rounded-pill px-4" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#defaultServiceModal{{ $index }}">
                                Learn More
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Default Service Modal -->
            <div class="modal fade" id="defaultServiceModal{{ $index }}" tabindex="-1" aria-labelledby="defaultServiceModalLabel{{ $index }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 700px;">
                    <div class="modal-content">
                        <div class="modal-header border-0 pb-2">
                            <h5 class="modal-title fw-bold" id="defaultServiceModalLabel{{ $index }}">{{ $service['name'] }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-3">
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <img src="{{ asset($service['image']) }}" 
                                         class="img-fluid rounded-3 zoom-image" 
                                         alt="{{ $service['name'] }}" 
                                         style="width: 100%; height: 220px; object-fit: cover; cursor: zoom-in;"
                                         data-bs-toggle="modal" 
                                         data-bs-target="#defaultImageModal{{ $index }}"
                                         onclick="event.stopPropagation();">
                                </div>
                                <div class="col-md-7">
                                    <p class="text-muted mb-3">{{ $service['description'] }}</p>
                                    
                                    <p class="text-muted mb-3">
                                        Professional care using latest technology and techniques for your comfort and satisfaction.
                                    </p>
                                    
                                    <div class="mb-3">
                                        <h6 class="fw-bold mb-2">Benefits:</h6>
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Professional treatment</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Modern equipment</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Affordable pricing</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="alert alert-light border mb-0 py-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted">Starting Price:</span>
                                            <span class="text-primary fw-bold fs-5">Rs. {{ number_format($service['price'], 0) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-2 pb-3">
                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                            <a href="{{ route('appointment.create') }}" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-calendar-check me-2"></i>Book Appointment
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Default Image Zoom Modal -->
            <div class="modal fade" id="defaultImageModal{{ $index }}" tabindex="-1" aria-hidden="true" data-bs-backdrop="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-transparent border-0">
                        <div class="modal-body p-0 position-relative">
                            <button type="button" class="image-modal-close" data-bs-dismiss="modal" aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                            <img src="{{ asset($service['image']) }}" class="img-fluid rounded-3" alt="{{ $service['name'] }}" style="width: 100%; max-height: 80vh; object-fit: contain;" onclick="document.getElementById('defaultImageModal{{ $index }}').querySelector('.image-modal-close').click();">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

<!-- Choose Service CTA Section -->
<section class="py-4" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);">
    <div class="container">
        <div class="row align-items-center" data-aos="fade-up">
            <div class="col-lg-1 col-md-2 text-center mb-3 mb-md-0">
                <div class="service-cta-icon bg-white rounded-circle d-inline-flex align-items-center justify-content-center" 
                     style="width: 70px; height: 70px;">
                    <i class="fas fa-calendar-alt" style="font-size: 2rem; color: #1e40af;"></i>
                </div>
            </div>
            <div class="col-lg-7 col-md-6 text-center text-md-start mb-3 mb-md-0">
                <h3 class="text-white fw-bold mb-2" style="font-size: 1.5rem;">Choose the Service You Want</h3>
                <p class="text-white mb-0" style="opacity: 0.95;">Select from our range of dental and aesthetic treatments and book your appointment easily.</p>
            </div>
            <div class="col-lg-4 col-md-4 text-center text-md-end">
                <div class="d-flex gap-3 justify-content-center justify-content-md-end flex-wrap">
                    <a href="{{ route('appointment.create') }}" class="btn btn-light px-4 py-2 rounded-pill fw-semibold">
                        Make Appointment
                    </a>
                    <a href="{{ route('services.operative') }}" class="btn btn-outline-light px-4 py-2 rounded-pill fw-semibold" 
                       style="border: 2px solid white;">
                        All Services
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3" style="font-family: var(--font-heading); color: var(--primary-blue-dark);">
                We Provide Excellence in Dental
            </h2>
            <p class="text-muted lead">What makes us different</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center p-4 feature-box">
                    <div class="mb-4">
                        <div class="feature-icon bg-light-blue rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px;">
                            <i class="fas fa-user-md fa-3x text-primary"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3">Expert Dentists</h5>
                    <p class="text-muted">Highly qualified professionals with years of experience</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center p-4 feature-box">
                    <div class="mb-4">
                        <div class="feature-icon bg-light-blue rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px;">
                            <i class="fas fa-laptop-medical fa-3x text-primary"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3">Modern Technology</h5>
                    <p class="text-muted">Latest dental equipment and advanced techniques</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center p-4 feature-box">
                    <div class="mb-4">
                        <div class="feature-icon bg-light-blue rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px;">
                            <i class="fas fa-heart fa-3x text-primary"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3">Patient Care</h5>
                    <p class="text-muted">Your comfort and satisfaction is our priority</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="text-center p-4 feature-box">
                    <div class="mb-4">
                        <div class="feature-icon bg-light-blue rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px;">
                            <i class="fas fa-shield-alt fa-3x text-primary"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3">Safe & Hygienic</h5>
                    <p class="text-muted">Highest safety and hygiene standards maintained</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Meet Our Lead Surgeon -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3" style="font-family: var(--font-heading); color: var(--primary-blue-dark);">
                Meet Our Lead Dental Surgeon
            </h2>
            <p class="text-muted lead">Expert care from experienced professionals</p>
        </div>

        <div class="row justify-content-center">
            @if($leadDoctor)
            <div class="col-lg-10" data-aos="fade-up">
                <div class="card border-0 shadow-lg doctor-card">
                    <div class="row g-0">
                        <div class="col-md-5">
                            @if($leadDoctor->image)
                            <img src="{{ asset($leadDoctor->image) }}" 
                                 class="img-fluid h-100 w-100" 
                                 alt="{{ $leadDoctor->name }}"
                                 style="object-fit: cover; border-radius: 12px 0 0 12px;">
                            @else
                            <div class="bg-gradient-blue h-100 d-flex align-items-center justify-content-center" style="border-radius: 12px 0 0 12px; min-height: 400px;">
                                <span class="text-white" style="font-size: 10rem; font-weight: 700;">
                                    {{ substr($leadDoctor->name, 0, 1) }}
                                </span>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-5">
                                <h3 class="fw-bold mb-2" style="font-size: 2rem;">Dr. {{ $leadDoctor->name }}</h3>
                                <p class="text-primary mb-3 fw-semibold fs-5">{{ $leadDoctor->specialization }}</p>
                                @if($leadDoctor->qualification)
                                <p class="text-muted small mb-3">{{ $leadDoctor->qualification }}</p>
                                @endif
                                <p class="text-muted mb-4" style="line-height: 1.8; font-size: 1.05rem;">
                                    {{ $leadDoctor->bio }}
                                </p>
                                <a href="{{ route('doctor.show', $leadDoctor->id) }}" class="btn btn-primary btn-lg px-5 rounded-pill">
                                    View Full Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-lg-10" data-aos="fade-up">
                <div class="card border-0 shadow-lg doctor-card">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <div class="bg-gradient-blue h-100 d-flex align-items-center justify-content-center" style="border-radius: 12px 0 0 12px; min-height: 400px;">
                                <i class="fas fa-user-md text-white" style="font-size: 8rem;"></i>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-5">
                                <h3 class="fw-bold mb-2" style="font-size: 2rem;">No Lead Doctor Set</h3>
                                <p class="text-primary mb-3 fw-semibold fs-5">Coming Soon</p>
                                <p class="text-muted mb-4" style="line-height: 1.8; font-size: 1.05rem;">
                                    A lead doctor will be displayed here soon. Please check back later.
                                </p>
                                <a href="{{ route('team') }}" class="btn btn-primary btn-lg px-5 rounded-pill">
                                    View Our Team
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>


<!-- Expert Tips Section -->
<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3" style="font-family: var(--font-heading); color: var(--primary-blue-dark);">
                Expert Tips
            </h2>
            <p class="text-muted lead">Skin Care & Aesthetic Insights</p>
        </div>

        <div class="row g-4">
            @forelse($tips as $tip)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index * 100) }}">
                <div class="tip-card h-100">
                    <div class="tip-image">
                        @if($tip->image)
                        <img src="{{ asset($tip->image) }}" alt="{{ $tip->title }}" class="img-fluid" style="object-fit: cover; height: 250px; width: 100%;">
                        @else
                        <div style="height: 250px; width: 100%; background: linear-gradient(135deg, #0066FF 0%, #0047BB 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image text-white" style="font-size: 3rem; opacity: 0.3;"></i>
                        </div>
                        @endif
                        <div class="tip-overlay">
                            <span class="tip-category">{{ $tip->category }}</span>
                        </div>
                    </div>
                    <div class="tip-content p-4">
                        <h5 class="fw-bold mb-3">{{ $tip->title }}</h5>
                        <p class="text-muted mb-3">{{ Str::limit($tip->description, 100) }}</p>
                        <button type="button" class="text-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#tipModal{{ $tip->id }}">
                            Read More <i class="fas fa-arrow-right ms-1"></i>
                        </button>
                    </div>
                </div>

                <!-- Expert Tip Modal -->
                <div class="modal fade" id="tipModal{{ $tip->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title fw-bold">{{ $tip->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                @if($tip->image)
                                <img src="{{ asset($tip->image) }}" alt="{{ $tip->title }}" class="img-fluid mb-4" style="max-height: 300px; object-fit: cover; width: 100%; border-radius: 8px;" />
                                @endif
                                <div class="mb-3">
                                    <span class="badge bg-primary mb-3">{{ $tip->category }}</span>
                                </div>
                                <p class="text-muted" style="line-height: 1.8;">{{ nl2br(e($tip->description)) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <p class="text-muted mb-0">No expert tips available at the moment.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-gradient-blue text-white">
    <div class="container py-5">
        <div class="row align-items-center" data-aos="fade-up">
            <div class="col-lg-8 text-center text-lg-start mb-4 mb-lg-0">
                <h2 class="display-6 fw-bold mb-3 text-white">Ready to Transform Your Smile?</h2>
                <p class="lead mb-0">Book your appointment today and experience the difference</p>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <a href="{{ route('appointment.create') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill">
                    <i class="fas fa-calendar-check me-2"></i>
                    Book Now
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('frontend-scripts')
<script>
// Fix modal backdrop issue when closing image zoom modal
document.addEventListener('DOMContentLoaded', function() {
    // Get all image zoom modals
    const imageModals = document.querySelectorAll('[id^="imageModal"], [id^="defaultImageModal"]');
    
    imageModals.forEach(function(modal) {
        modal.addEventListener('hidden.bs.modal', function () {
            // Remove any leftover backdrops
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(function(backdrop) {
                backdrop.remove();
            });
            
            // Remove modal-open class from body if no modals are open
            const openModals = document.querySelectorAll('.modal.show');
            if (openModals.length === 0) {
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            }
        });
    });
});
</script>
@endpush



@push('frontend-styles')
<style>
.service-card,
.blog-card,
.doctor-card,
.tip-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px !important;
    overflow: hidden;
}

.service-card:hover,
.blog-card:hover,
.tip-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
}

/* Expert Tips Section */
.tip-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.tip-image {
    position: relative;
    overflow: hidden;
    height: 250px;
}

.tip-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.tip-card:hover .tip-image img {
    transform: scale(1.1);
}

.tip-overlay {
    position: absolute;
    top: 20px;
    left: 20px;
}

.tip-category {
    background: var(--primary-blue);
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.tip-content h5 {
    color: var(--primary-blue-dark);
    line-height: 1.4;
}

.tip-content a {
    text-decoration: none;
    transition: all 0.3s ease;
}

.tip-content a:hover {
    color: var(--primary-blue-dark) !important;
}

.tip-content a i {
    transition: transform 0.3s ease;
}

.tip-content a:hover i {
    transform: translateX(5px);
}

.feature-box {
    transition: transform 0.3s ease;
}

.feature-box:hover {
    transform: translateY(-5px);
}

.feature-icon {
    transition: all 0.3s ease;
}

.feature-box:hover .feature-icon {
    transform: scale(1.1);
    background: var(--primary-blue) !important;
}

.feature-box:hover .feature-icon i {
    color: white !important;
}

.hero-section {
    position: relative;
}

/* Statistics Section */
.stats-card {
    transition: transform 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-5px);
}

.stats-number {
    font-size: 2.5rem;
    color: var(--primary-blue-dark);
    font-family: var(--font-heading);
}

.stats-icon {
    transition: transform 0.3s ease;
}

.stats-card:hover .stats-icon {
    transform: scale(1.1);
}

/* Service CTA Section */
.service-cta-icon {
    transition: transform 0.3s ease;
}

.service-cta-icon:hover {
    transform: scale(1.1);
}

.btn-outline-light:hover {
    background: white !important;
    color: var(--primary-blue) !important;
}

@media (max-width: 768px) {
    .display-2 {
        font-size: 2.5rem;
    }
    
    .display-5 {
        font-size: 2rem;
    }
    
    .stats-number {
        font-size: 2rem;
    }
}
</style>
@endpush

@push('frontend-scripts')
<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        offset: 100
    });

    // Counter Animation
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-count'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target + '+';
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current) + '+';
            }
        }, 16);
    }

    // Trigger counter animation when stats section is visible
    const observerOptions = {
        threshold: 0.5
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('.stats-number');
                counters.forEach(counter => {
                    if (counter.textContent === '0') {
                        animateCounter(counter);
                    }
                });
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe stats section
    document.addEventListener('DOMContentLoaded', () => {
        const statsSection = document.querySelector('.stats-card')?.closest('section');
        if (statsSection) {
            observer.observe(statsSection);
        }
    });
</script>
@endpush
