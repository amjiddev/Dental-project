@extends('frontend.layouts.frontend')

@section('meta_title', 'Contact Us - Dental Clinic')
@section('meta_description', 'Get in touch with our dental clinic. Visit us, call us, or send us a message.')

@section('frontend-content')

<!-- Page Header -->
<section class="bg-gradient-blue text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold mb-3 text-white">Contact Us</h1>
                <p class="lead mb-0">We'd love to hear from you. Get in touch with us today!</p>
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
                                <p class="text-muted mb-0">123 Main Street<br>City, State 12345</p>
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
                                    <a href="tel:+15551234567" class="text-muted text-decoration-none">+1 (555) 123-4567</a>
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
                                    <a href="mailto:info@dentalclinic.com" class="text-muted text-decoration-none">info@dentalclinic.com</a>
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
                                <p class="text-muted mb-1">Mon - Fri: 9:00 AM - 6:00 PM</p>
                                <p class="text-muted mb-0">Sat: 9:00 AM - 2:00 PM</p>
                            </div>
                        </div>

                        <!-- WhatsApp Button -->
                        <div class="mt-4">
                            <a href="https://wa.me/1234567890?text=Hello%2C%20I%20would%20like%20to%20book%20an%20appointment" 
                               target="_blank" 
                               class="btn btn-success w-100">
                                <i class="fab fa-whatsapp me-2"></i>
                                Chat on WhatsApp
                            </a>
                        </div>

                        <!-- Social Media -->
                        <div class="mt-4">
                            <h5 class="h6 mb-3">Follow Us</h5>
                            <div class="d-flex gap-2">
                                <a href="https://facebook.com" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://instagram.com" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="https://twitter.com" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://linkedin.com" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
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
                                    <label for="name" class="form-label">Your Name <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone') }}">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Subject -->
                                <div class="col-md-6">
                                    <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('subject') is-invalid @enderror" 
                                           id="subject" 
                                           name="subject" 
                                           value="{{ old('subject') }}" 
                                           required>
                                    @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Message -->
                                <div class="col-12">
                                    <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" 
                                              id="message" 
                                              name="message" 
                                              rows="6" 
                                              required>{{ old('message') }}</textarea>
                                    @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
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
                <!-- Google Maps Embed -->
                <div class="google-map-container" style="height: 450px; width: 100%;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1841!2d-73.9875!3d40.7484!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1234567890"
                        width="100%" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="https://www.google.com/maps/dir//123+Main+Street+City+State+12345" 
               target="_blank" 
               class="btn btn-outline-primary">
                <i class="fas fa-directions me-2"></i>
                Get Directions
            </a>
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
                    <a href="tel:+15551234567" class="btn btn-light btn-lg">
                        <i class="fas fa-phone me-2"></i>
                        Call Now
                    </a>
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
    // Auto-dismiss success message after 5 seconds
    setTimeout(function() {
        var alert = document.querySelector('.alert-success');
        if (alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000);
</script>
@endpush
