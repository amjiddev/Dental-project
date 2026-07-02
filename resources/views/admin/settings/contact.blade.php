<x-default-layout>

    @section('title')
        Contact Us Settings
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.settings.contact') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="fw-bold m-0">Contact Us Settings</h3>
            </div>
        </div>

        <div class="card-body pt-0">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="ki-duotone ki-check-circle fs-2 me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.settings.contact.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-5">
                    <!-- Page Header -->
                    <div class="col-12">
                        <h4 class="fw-bold text-primary mb-3">Page Header</h4>
                    </div>

                    <!-- Contact Heading -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Heading</label>
                        <input type="text" name="contact_heading" class="form-control" value="{{ old('contact_heading', $settings['contact_heading'] ?? 'Contact Us') }}" required>
                    </div>

                    <!-- Contact Subtitle -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Subtitle</label>
                        <input type="text" name="contact_subtitle" class="form-control" value="{{ old('contact_subtitle', $settings['contact_subtitle'] ?? 'We\'d love to hear from you. Get in touch with us today!') }}" required>
                    </div>
                    
                    <div class="col-12">
                        <hr class="my-2">
                        <h4 class="fw-bold text-primary mb-3">Contact Information</h4>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Phone Number</label>
                        <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $settings['contact_phone'] ?? '+1 (555) 123-4567') }}" required>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email Address</label>
                        <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $settings['contact_email'] ?? 'info@dentalclinic.com') }}" required>
                    </div>

                    <div class="col-12">
                        <hr class="my-2">
                        <h4 class="fw-bold text-primary mb-3">Business Hours</h4>
                    </div>

                    <!-- Weekday Hours -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Monday - Friday</label>
                        <input type="text" name="contact_hours_weekday" class="form-control" value="{{ old('contact_hours_weekday', $settings['contact_hours_weekday'] ?? '9:00 AM - 6:00 PM') }}" required>
                    </div>

                    <!-- Saturday Hours -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Saturday</label>
                        <input type="text" name="contact_hours_saturday" class="form-control" value="{{ old('contact_hours_saturday', $settings['contact_hours_saturday'] ?? '9:00 AM - 2:00 PM') }}" required>
                    </div>

                    <!-- Sunday Hours -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Sunday</label>
                        <input type="text" name="contact_hours_sunday" class="form-control" value="{{ old('contact_hours_sunday', $settings['contact_hours_sunday'] ?? 'Closed') }}">
                    </div>

                    <div class="col-12">
                        <hr class="my-2">
                        <h4 class="fw-bold text-primary mb-3">WhatsApp</h4>
                    </div>

                    <!-- WhatsApp Number -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">WhatsApp Number</label>
                        <input type="text" name="contact_whatsapp" class="form-control" value="{{ old('contact_whatsapp', $settings['contact_whatsapp'] ?? '1234567890') }}" placeholder="Enter number without + or spaces">
                        <div class="form-text">Enter the number in international format without + or spaces (e.g., 1234567890)</div>
                    </div>

                    <div class="col-12">
                        <hr class="my-2">
                        <h4 class="fw-bold text-primary mb-3">Social Media Links</h4>
                    </div>

                    <!-- Facebook -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Facebook URL</label>
                        <input type="url" name="contact_facebook" class="form-control" value="{{ old('contact_facebook', $settings['contact_facebook'] ?? 'https://facebook.com') }}" placeholder="https://facebook.com/yourpage">
                    </div>

                    <!-- Instagram -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Instagram URL</label>
                        <input type="url" name="contact_instagram" class="form-control" value="{{ old('contact_instagram', $settings['contact_instagram'] ?? 'https://instagram.com') }}" placeholder="https://instagram.com/yourpage">
                    </div>

                    <!-- Twitter -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Twitter URL</label>
                        <input type="url" name="contact_twitter" class="form-control" value="{{ old('contact_twitter', $settings['contact_twitter'] ?? 'https://twitter.com') }}" placeholder="https://twitter.com/yourpage">
                    </div>

                    <!-- LinkedIn -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">LinkedIn URL</label>
                        <input type="url" name="contact_linkedin" class="form-control" value="{{ old('contact_linkedin', $settings['contact_linkedin'] ?? 'https://linkedin.com') }}" placeholder="https://linkedin.com/company/yourpage">
                    </div>

                </div>

                <div class="d-flex justify-content-end mt-8">
                    <button type="submit" class="btn btn-primary">
                        <i class="ki-duotone ki-check fs-2"></i>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide success and alert messages after 5 seconds
    const alerts = document.querySelectorAll('.alert-success, .alert-danger, .alert-warning, .alert-info');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            // Fade out effect
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            
            // Remove from DOM after fade
            setTimeout(function() {
                alert.remove();
            }, 500);
        }, 5000); // 5 seconds
    });
});
</script>

</x-default-layout>
