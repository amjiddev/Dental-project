@extends('frontend.layouts.frontend')

@section('meta_title', 'Book Appointment - Manji Dental')
@section('meta_description', 'Book your dental appointment online. Choose your preferred service, doctor, date and time.')

@section('frontend-content')

<!-- Page Header -->
<section class="bg-gradient-blue text-white py-5">
    <div class="container py-4">
        <div class="text-center" data-aos="fade-up">
            <h1 class="display-4 fw-bold mb-3 text-white">Book an Appointment</h1>
            <p class="lead mb-0">Schedule your visit with our expert dental team</p>
        </div>
    </div>
</section>

<!-- Appointment Form -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <h3 class="h4 fw-bold mb-4 text-primary">Fill in Your Details</h3>
                        
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form action="{{ route('appointment.store') }}" method="POST">
                            @csrf
                            
                            <div class="row g-4">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your full name" pattern="[a-zA-Z\s]+" title="Name can only contain letters and spaces" required>
                                    @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="your@email.com" required>
                                    @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label fw-semibold">Phone <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+1 (622) 936-6659" pattern="[\+]?[0-9\s\(\)\-]{10,20}" title="Phone format examples: +1 (622) 936-6659, +92-300-1234567, 300-123-4567" required>
                                    @error('phone')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>

                                <!-- Service -->
                                <div class="col-md-6">
                                    <label for="service_id" class="form-label fw-semibold">Select Service <span class="text-danger">*</span></label>
                                    <select class="form-select @error('service_id') is-invalid @enderror" id="service_id" name="service_id" required>
                                        <option value="">Choose a service...</option>
                                        @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ (old('service_id') ?? $selectedServiceId) == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('service_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>

                                <!-- Treatment Option -->
                                <div class="col-md-6">
                                    <label for="treatment_option_id" class="form-label fw-semibold">Treatment Option</label>
                                    <select class="form-select @error('treatment_option_id') is-invalid @enderror" id="treatment_option_id" name="treatment_option_id">
                                        <option value="">Choose a treatment...</option>
                                        @if(!empty($treatments) && count($treatments) > 0)
                                            @foreach($treatments as $treatment)
                                            <option value="{{ $treatment['id'] ?? $treatment->id ?? '' }}" {{ (old('treatment_option_id') ?? $selectedTreatmentId) == ($treatment['id'] ?? $treatment->id ?? '') ? 'selected' : '' }}>
                                                {{ $treatment['name'] ?? $treatment->name ?? '' }}
                                            </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('treatment_option_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>

                                <!-- Doctor -->
                                <div class="col-md-6">
                                    <label for="doctor_id" class="form-label fw-semibold">Preferred Doctor</label>
                                    <select class="form-select @error('doctor_id') is-invalid @enderror" id="doctor_id" name="doctor_id">
                                        <option value="">Any available doctor...</option>
                                        @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }} - {{ $doctor->specialization }}</option>
                                        @endforeach
                                    </select>
                                    @error('doctor_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>

                                <!-- Date -->
                                <div class="col-md-6">
                                    <label for="appointment_date" class="form-label fw-semibold">Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('appointment_date') is-invalid @enderror" id="appointment_date" name="appointment_date" value="{{ old('appointment_date') }}" min="{{ date('Y-m-d') }}" required>
                                    @error('appointment_date')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>

                                <!-- Time -->
                                <div class="col-md-6">
                                    <label for="appointment_time" class="form-label fw-semibold">Time <span class="text-danger">*</span></label>
                                    <select class="form-select @error('appointment_time') is-invalid @enderror" id="appointment_time" name="appointment_time" required>
                                        <option value="">Choose a time...</option>
                                        <option value="09:00" {{ old('appointment_time') == '09:00' ? 'selected' : '' }}>09:00 AM</option>
                                        <option value="10:00" {{ old('appointment_time') == '10:00' ? 'selected' : '' }}>10:00 AM</option>
                                        <option value="11:00" {{ old('appointment_time') == '11:00' ? 'selected' : '' }}>11:00 AM</option>
                                        <option value="12:00" {{ old('appointment_time') == '12:00' ? 'selected' : '' }}>12:00 PM</option>
                                        <option value="14:00" {{ old('appointment_time') == '14:00' ? 'selected' : '' }}>02:00 PM</option>
                                        <option value="15:00" {{ old('appointment_time') == '15:00' ? 'selected' : '' }}>03:00 PM</option>
                                        <option value="16:00" {{ old('appointment_time') == '16:00' ? 'selected' : '' }}>04:00 PM</option>
                                        <option value="17:00" {{ old('appointment_time') == '17:00' ? 'selected' : '' }}>05:00 PM</option>
                                    </select>
                                    @error('appointment_time')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>

                                <!-- Message -->
                                <div class="col-12">
                                    <label for="message" class="form-label fw-semibold">Additional Message</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="4" placeholder="Any specific concerns..." maxlength="1000">{{ old('message') }}</textarea>
                                    <small class="text-muted">Max 1000 characters</small>
                                    @error('message')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>

                                <!-- Submit -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill">
                                        <i class="fas fa-calendar-check me-2"></i>Book Appointment
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Contact Cards -->
                <div class="row g-4 mt-4">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                                <h6 class="fw-bold mb-2">Call Us</h6>
                                <p class="text-muted mb-0 small">+92 300 1234567</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                                <h6 class="fw-bold mb-2">Email Us</h6>
                                <p class="text-muted mb-0 small">info@manjidental.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <i class="fab fa-whatsapp fa-2x text-success mb-3"></i>
                                <h6 class="fw-bold mb-2">WhatsApp</h6>
                                <p class="text-muted mb-0 small">Quick Response</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

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

    // Dynamic treatment loading
    document.addEventListener('DOMContentLoaded', function() {
        const serviceSelect = document.getElementById('service_id');
        const treatmentSelect = document.getElementById('treatment_option_id');

        serviceSelect.addEventListener('change', function() {
            const serviceId = this.value;
            
            if (!serviceId) {
                treatmentSelect.innerHTML = '<option value="">Choose a treatment...</option>';
                return;
            }

            // Fetch treatments for the selected service
            fetch(`/api/services/${serviceId}/treatments`)
                .then(response => response.json())
                .then(data => {
                    treatmentSelect.innerHTML = '<option value="">Choose a treatment...</option>';
                    
                    if (data.treatments && data.treatments.length > 0) {
                        data.treatments.forEach(treatment => {
                            const option = document.createElement('option');
                            option.value = treatment.id;
                            option.textContent = treatment.name;
                            treatmentSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error loading treatments:', error);
                });
        });
    });
</script>
@endpush
