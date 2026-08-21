<x-default-layout>

    @section('title')
        Home Page Settings
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.settings.home') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="fw-bold m-0">Home Page Settings</h3>
            </div>
        </div>

        <div class="card-body pt-0">
            @if(session('success'))
                <div class="alert alert-success mt-4">
                    <i class="ki-duotone ki-check-circle fs-2 me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.settings.home.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Section Visibility Toggles -->
                <div class="mb-8">
                    <h4 class="fw-bold mb-4">Section Visibility</h4>

                    <div class="row g-4">
                        <div class="col-md-3">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input visibility-toggle" type="checkbox" data-setting="home_show_services" {{ ($settings['home_show_services'] ?? '1') == '1' ? 'checked' : '' }}>
                                <span class="form-check-label fw-bold">Dental Services</span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input visibility-toggle" type="checkbox" data-setting="home_show_excellence" {{ ($settings['home_show_excellence'] ?? '1') == '1' ? 'checked' : '' }}>
                                <span class="form-check-label fw-bold">Excellence in Dental</span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input visibility-toggle" type="checkbox" data-setting="home_show_lead_surgeon" {{ ($settings['home_show_lead_surgeon'] ?? '1') == '1' ? 'checked' : '' }}>
                                <span class="form-check-label fw-bold">Lead Surgeon</span>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input visibility-toggle" type="checkbox" data-setting="home_show_expert_tips" {{ ($settings['home_show_expert_tips'] ?? '1') == '1' ? 'checked' : '' }}>
                                <span class="form-check-label fw-bold">Expert Tips</span>
                            </label>
                        </div>
                    </div>
                </div>

                <hr class="my-6">

                <!-- Hero Section -->
                <div class="mb-8">
                    <h4 class="fw-bold mb-4">Hero Section</h4>
                    <div class="row g-5">
                        <div class="col-12">
                            <label class="form-label fw-bold">Hero Image</label>
                            <div class="mb-3">
                                @if($settings['home_hero_image'] ?? false)
                                    <div class="mb-3">
                                        <img src="{{ asset($settings['home_hero_image']) }}" alt="Hero Image" class="rounded" style="max-height: 200px; object-fit: cover;">
                                    </div>
                                @endif
                                <input type="file" name="home_hero_image" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Title</label>
                            <input type="text" name="home_hero_title" class="form-control" value="{{ old('home_hero_title', $settings['home_hero_title'] ?? 'We bring together expert dental and aesthetic care') }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="home_hero_description" class="form-control" rows="3" required>{{ old('home_hero_description', $settings['home_hero_description'] ?? 'We bring together expert dental and aesthetic care with a passion for creating healthy, beautiful smiles & skins. Every treatment is tailored to your needs, ensuring comfort and results that last.') }}</textarea>
                        </div>
                    </div>
                </div>

                <hr class="my-6">

                <!-- Statistics Section -->
                <div class="mb-8">
                    <h4 class="fw-bold mb-4">Statistics Section</h4>
                    <div class="row g-5">
                        @for($i = 1; $i <= 4; $i++)
                        <div class="col-md-6">
                            <div class="card card-bordered">
                                <div class="card-header">
                                    <h5 class="card-title">Stat {{ $i }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-4">
                                            <label class="form-label">Number</label>
                                            <input type="text" name="home_stat_{{ $i }}_number" class="form-control" value="{{ old('home_stat_' . $i . '_number', $settings['home_stat_' . $i . '_number'] ?? ($i == 1 ? '10' : ($i == 2 ? '6' : ($i == 3 ? '2300' : '500')))) }}" required>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Label</label>
                                            <input type="text" name="home_stat_{{ $i }}_label" class="form-control" value="{{ old('home_stat_' . $i . '_label', $settings['home_stat_' . $i . '_label'] ?? ($i == 1 ? 'Years of Expertise' : ($i == 2 ? 'Expert Doctors' : ($i == 3 ? 'Satisfied Patients' : 'Successful Treatments')))) }}" required>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Icon Class</label>
                                            <input type="text" name="home_stat_{{ $i }}_icon" class="form-control" value="{{ old('home_stat_' . $i . '_icon', $settings['home_stat_' . $i . '_icon'] ?? ($i == 1 ? 'fas fa-tooth' : ($i == 2 ? 'fas fa-user-md' : ($i == 3 ? 'fas fa-smile' : 'fas fa-award')))) }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <hr class="my-6">

                <!-- About / Creating Beauty Section -->
                <div class="mb-8">
                    <h4 class="fw-bold mb-4">"Creating Beauty Through Healthy Smiles" Section <span class="badge badge-light-warning">Shared with About Page</span></h4>
                    <div class="row g-5">
                        <div class="col-12">
                            <label class="form-label fw-bold">Image <span class="text-muted">(Changing this also changes the About Us page image)</span></label>
                            <div class="mb-3">
                                @if($settings['about_image'] ?? false)
                                    <div class="mb-3">
                                        <img src="{{ asset($settings['about_image']) }}" alt="About Image" class="rounded" style="max-height: 200px; object-fit: cover;">
                                    </div>
                                @endif
                                <input type="file" name="about_image" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Heading</label>
                            <input type="text" name="home_about_heading" class="form-control" value="{{ old('home_about_heading', $settings['home_about_heading'] ?? 'Creating Beauty Through Healthy Smiles') }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="home_about_description" class="form-control" rows="4" required>{{ old('home_about_description', $settings['home_about_description'] ?? 'Welcome to BrightSmile Dental Clinic, Lahore\'s trusted choice for dental and facial aesthetic care. We offer cosmetic and general dentistry, smile makeovers, and advanced facial treatments using modern technology and expert care.') }}</textarea>
                        </div>
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

    const toggles = document.querySelectorAll('.visibility-toggle');
    
    toggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const setting = this.getAttribute('data-setting');
            const value = this.checked ? '1' : '0';
            
            // Send AJAX request
            fetch('{{ route("admin.settings.toggle-section") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    setting: setting,
                    value: value
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success notification
                    showNotification('Section visibility updated!', 'success');
                } else {
                    // Revert toggle on error
                    this.checked = !this.checked;
                    showNotification('Error updating section visibility', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Revert toggle on error
                this.checked = !this.checked;
                showNotification('Error updating section visibility', 'error');
            });
        });
    });
    
    function showNotification(message, type) {
        // Use toastr if available
        if (typeof toastr !== 'undefined') {
            if (type === 'success') {
                toastr.success(message);
            } else {
                toastr.error(message);
            }
        } else {
            // Fallback to alert
            alert(message);
        }
    }
});
</script>

</x-default-layout>
