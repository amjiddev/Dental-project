@extends('frontend.layouts.frontend')

@section('meta_title', 'Contact Us - Dental Clinic')
@section('meta_description', 'Get in touch with our dental clinic. Visit us, call us, or send us a message.')

@section('frontend-content')

<!-- Page Header -->
<section class="bg-gradient-blue text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold mb-3 text-white">{{ $settings['contact_heading'] ?? 'Contact Us' }}</h1>
                <p class="lead mb-0">{{ $settings['contact_subtitle'] ?? 'We\'d love to hear from you. Get in touch with us today!' }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information & Form -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="h4 mb-4">Get In Touch</h3>
                        
                        <!-- Address -->
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="bg-light-blue rounded-circle p-3">
                                    <i class="fas fa-map-marker-alt text-primary fa-lg"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="h6 mb-1">Address</h5>
                                <p class="text-muted mb-0">{{ nl2br(e($settings['contact_address'] ?? '123 Main Street<br>City, State 12345')) }}</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="bg-light-blue rounded-circle p-3">
                                    <i class="fas fa-phone text-primary fa-lg"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="h6 mb-1">Phone</h5>
                                <p class="mb-0">
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['contact_phone'] ?? '') }}" class="text-muted text-decoration-none">{{ $settings['contact_phone'] ?? '+1 (555) 123-4567' }}</a>
                                </p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="bg-light-blue rounded-circle p-3">
                                    <i class="fas fa-envelope text-primary fa-lg"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="h6 mb-1">Email</h5>
                                <p class="mb-0">
                                    <a href="mailto:{{ $settings['contact_email'] ?? 'info@dentalclinic.com' }}" class="text-muted text-decoration-none">{{ $settings['contact_email'] ?? 'info@dentalclinic.com' }}</a>
                                </p>
                            </div>
                        </div>

                        <!-- Hours -->
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="bg-light-blue rounded-circle p-3">
                                    <i class="fas fa-clock text-primary fa-lg"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="h6 mb-1">Business Hours</h5>
                                <p class="text-muted mb-1">Mon - Fri: {{ $settings['contact_hours_weekday'] ?? '9:00 AM - 6:00 PM' }}</p>
                                <p class="text-muted mb-1">Sat: {{ $settings['contact_hours_saturday'] ?? '9:00 AM - 2:00 PM' }}</p>
                                @if(!empty($settings['contact_hours_sunday']) && $settings['contact_hours_sunday'] !== 'Closed')
                                <p class="text-muted mb-0">Sun: {{ $settings['contact_hours_sunday'] }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- WhatsApp Button -->
                        @if(!empty($settings['contact_whatsapp']))
                        <div class="mt-4">
                            <a href="https://wa.me/{{ $settings['contact_whatsapp'] }}?text=Hello%2C%20I%20would%20like%20to%20book%20an%20appointment" 
                               target="_blank" 
                               class="btn btn-success w-100">
                                <i class="fab fa-whatsapp me-2"></i>
                                Chat on WhatsApp
                            </a>
                        </div>
                        @endif

                        <!-- Social Media -->
                        @if(!empty($settings['contact_facebook']) || !empty($settings['contact_instagram']) || !empty($settings['contact_twitter']) || !empty($settings['contact_linkedin']))
                        <div class="mt-4">
                            <h5 class="h6 mb-3">Follow Us</h5>
                            <div class="d-flex gap-2">
                                @if(!empty($settings['contact_facebook']))
                                <a href="{{ $settings['contact_facebook'] }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                @endif
                                @if(!empty($settings['contact_instagram']))
                                <a href="{{ $settings['contact_instagram'] }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                @endif
                                @if(!empty($settings['contact_twitter']))
                                <a href="{{ $settings['contact_twitter'] }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                @endif
                                @if(!empty($settings['contact_linkedin']))
                                <a href="{{ $settings['contact_linkedin'] }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="h4 mb-4">Send Us a Message</h3>

                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            
                            <div class="row g-3">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-bold">
                                        Your Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           placeholder="Enter your full name"
                                           minlength="2"
                                           maxlength="255"
                                           required>
                                    @error('name')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-bold">
                                        Email Address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="your.email@example.com"
                                           maxlength="255"
                                           required>
                                    @error('email')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label fw-bold">
                                        Phone Number
                                        <span class="text-muted">(optional)</span>
                                    </label>
                                    <input type="tel" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone') }}"
                                           placeholder="+1 (555) 000-0000"
                                           minlength="10"
                                           maxlength="20">
                                    @error('phone')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Subject -->
                                <div class="col-md-6">
                                    <label for="subject" class="form-label fw-bold">
                                        Subject
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('subject') is-invalid @enderror" 
                                           id="subject" 
                                           name="subject" 
                                           value="{{ old('subject') }}" 
                                           placeholder="What is this about?"
                                           minlength="3"
                                           maxlength="255"
                                           required>
                                    @error('subject')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Message -->
                                <div class="col-12">
                                    <label for="message" class="form-label fw-bold">
                                        Message
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" 
                                              id="message" 
                                              name="message" 
                                              rows="6" 
                                              placeholder="Please share your message with us..."
                                              minlength="10"
                                              maxlength="2000"
                                              required>{{ old('message') }}</textarea>
                                    <div class="form-text">
                                        <small id="charCount">0 / 2000 characters</small>
                                    </div>
                                    @error('message')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Google Maps Section -->
<section class="py-5 bg-light-blue">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">Find Us on Map</h2>
            <p class="section-subtitle">Visit our clinic for the best dental care</p>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="card-body p-0">
                <!-- Static Google Maps Embed -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d13559.441067865504!2d70.8997935111553!3d31.82879811855638!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1782972919919!5m2!1sen!2s" 
                        width="100%" 
                        height="450" 
                        style="border:0; display: block;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="strict-origin-when-cross-origin">
                </iframe>
            </div>
        </div>
    </div>
</section>

<!-- Quick Contact CTA -->
<section class="py-5">
    <div class="container">
        <div class="card bg-gradient-blue text-white border-0 shadow">
            <div class="card-body p-5 text-center">
                <h3 class="h2 mb-3 text-white">Need Immediate Assistance?</h3>
                <p class="lead mb-4">Call us now or book an appointment online</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    @if(!empty($settings['contact_phone']))
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['contact_phone']) }}" class="btn btn-light btn-lg">
                        <i class="fas fa-phone me-2"></i>
                        Call Now
                    </a>
                    @endif
                    <a href="{{ route('appointment.create') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-calendar me-2"></i>
                        Book Appointment
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('frontend-scripts')
<script>
    // Character counter for message textarea
    const messageTextarea = document.getElementById('message');
    const charCount = document.getElementById('charCount');
    
    if (messageTextarea && charCount) {
        messageTextarea.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = count + ' / 2000 characters';
            
            // Add warning when near limit
            if (count > 1800) {
                charCount.classList.add('text-danger');
            } else {
                charCount.classList.remove('text-danger');
            }
        });
        
        // Initialize count on page load
        const initialCount = messageTextarea.value.length;
        charCount.textContent = initialCount + ' / 2000 characters';
    }
    
    // Auto-dismiss success message after 5 seconds
    setTimeout(function() {
        var alert = document.querySelector('.alert-success');
        if (alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000);

    // Contact form validation
    const contactForm = document.querySelector('form[action="{{ route("contact.submit") }}"]');
    if (contactForm) {
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');

        // Validate name - only letters and spaces
        if (nameInput) {
            nameInput.addEventListener('input', function() {
                const value = this.value;
                const isValid = /^[a-zA-Z\s]*$/.test(value);
                
                if (!isValid && value.length > 0) {
                    this.classList.add('is-invalid');
                    // Remove any numbers that were typed
                    this.value = value.replace(/[0-9]/g, '');
                } else {
                    this.classList.remove('is-invalid');
                }
            });

            nameInput.addEventListener('blur', function() {
                const value = this.value.trim();
                if (value.length > 0 && !/^[a-zA-Z\s]+$/.test(value)) {
                    this.classList.add('is-invalid');
                }
            });
        }

        // Validate email format
        if (emailInput) {
            emailInput.addEventListener('blur', function() {
                const value = this.value.trim();
                const isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
                
                if (value.length > 0 && !isValidEmail) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });

            emailInput.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    const value = this.value.trim();
                    const isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
                    
                    if (isValidEmail) {
                        this.classList.remove('is-invalid');
                    }
                }
            });
        }

        // Form submission validation
        contactForm.addEventListener('submit', function(e) {
            const nameValue = nameInput?.value.trim() || '';
            const emailValue = emailInput?.value.trim() || '';

            let isValid = true;

            // Validate name
            if (!nameValue || !/^[a-zA-Z\s]+$/.test(nameValue)) {
                isValid = false;
                if (nameInput) {
                    nameInput.classList.add('is-invalid');
                }
            }

            // Validate email
            if (!emailValue || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailValue)) {
                isValid = false;
                if (emailInput) {
                    emailInput.classList.add('is-invalid');
                }
            }

            if (!isValid) {
                e.preventDefault();
                return false;
            }
        });
    }
</script>
@endpush
