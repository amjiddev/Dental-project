<x-default-layout>

    @section('title')
        About Us Settings
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('admin.settings.about') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="fw-bold m-0">About Us Settings</h3>
            </div>
        </div>

        <div class="card-body pt-0">
            <form action="{{ route('admin.settings.about.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-5">
                    <!-- About Image -->
                    <div class="col-12">
                        <label class="form-label fw-bold">About Image</label>
                        <div class="mb-3">
                            @if($settings['about_image'] ?? false)
                                <div class="symbol symbol-150px mb-3">
                                    <img src="{{ asset($settings['about_image']) }}" alt="About Image" class="rounded" style="max-height: 200px; object-fit: cover;">
                                </div>
                            @endif
                            <input type="file" name="about_image" class="form-control" accept="image/*">
                            <div class="form-text">Upload a new image to replace the current one. Recommended size: 800x600px</div>
                        </div>
                    </div>

                    <!-- About Heading -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Heading</label>
                        <input type="text" name="about_heading" class="form-control" value="{{ old('about_heading', $settings['about_heading'] ?? 'Welcome to Our Dental Clinic') }}" required>
                    </div>

                    <!-- About Subtitle -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Subtitle</label>
                        <input type="text" name="about_subtitle" class="form-control" value="{{ old('about_subtitle', $settings['about_subtitle'] ?? 'Providing quality dental care with a focus on patient comfort and satisfaction since 2010.') }}" required>
                    </div>

                    <!-- About Description -->
                    <div class="col-12">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="about_description" class="form-control" rows="4" required>{{ old('about_description', $settings['about_description'] ?? 'At our dental clinic, we believe that everyone deserves a healthy, beautiful smile. Our team of experienced dentists and staff are dedicated to providing the highest quality dental care in a comfortable and welcoming environment.') }}</textarea>
                    </div>

                    <!-- Features -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Feature 1</label>
                        <input type="text" name="about_feature_1" class="form-control" value="{{ old('about_feature_1', $settings['about_feature_1'] ?? 'Experienced Team') }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Feature 2</label>
                        <input type="text" name="about_feature_2" class="form-control" value="{{ old('about_feature_2', $settings['about_feature_2'] ?? 'Modern Equipment') }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Feature 3</label>
                        <input type="text" name="about_feature_3" class="form-control" value="{{ old('about_feature_3', $settings['about_feature_3'] ?? 'Patient Comfort') }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Feature 4</label>
                        <input type="text" name="about_feature_4" class="form-control" value="{{ old('about_feature_4', $settings['about_feature_4'] ?? 'Affordable Pricing') }}" required>
                    </div>

                    <div class="col-12">
                        <hr class="my-2">
                    </div>

                    <!-- Mission -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Mission Title</label>
                        <input type="text" name="mission_title" class="form-control" value="{{ old('mission_title', $settings['mission_title'] ?? 'Our Mission') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Mission Icon (FontAwesome Class)</label>
                        <input type="text" name="mission_icon" class="form-control" value="{{ old('mission_icon', $settings['mission_icon'] ?? 'fas fa-bullseye') }}" required>
                        <div class="form-text">Example: fas fa-bullseye, fas fa-heart, fas fa-star</div>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Mission Description</label>
                        <textarea name="mission_description" class="form-control" rows="3" required>{{ old('mission_description', $settings['mission_description'] ?? 'To provide exceptional dental care that improves the oral health and overall well-being of our patients. We strive to create a comfortable, caring environment where patients feel valued and respected.') }}</textarea>
                    </div>

                    <div class="col-12">
                        <hr class="my-2">
                    </div>

                    <!-- Vision -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Vision Title</label>
                        <input type="text" name="vision_title" class="form-control" value="{{ old('vision_title', $settings['vision_title'] ?? 'Our Vision') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Vision Icon (FontAwesome Class)</label>
                        <input type="text" name="vision_icon" class="form-control" value="{{ old('vision_icon', $settings['vision_icon'] ?? 'fas fa-eye') }}" required>
                        <div class="form-text">Example: fas fa-eye, fas fa-globe, fas fa-rocket</div>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Vision Description</label>
                        <textarea name="vision_description" class="form-control" rows="3" required>{{ old('vision_description', $settings['vision_description'] ?? 'To be the leading dental clinic in our community, known for our commitment to excellence, innovation, and patient satisfaction. We aim to set the standard for quality dental care.') }}</textarea>
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

</x-default-layout>
