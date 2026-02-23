@extends('frontend.layouts.frontend')

@section('meta_title', 'Student Registration')

@push('frontend-styles')
<style>
.conditional-fields {
    display: none;
}
.conditional-fields.active {
    display: block;
}
</style>
@endpush

@section('frontend-content')

<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold">Student Registration</h2>
                            <p class="text-muted">Join our academic community</p>
                        </div>

                        <form method="POST" action="{{ url('/register/student') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Account Information -->
                            <h5 class="fw-bold mb-3 text-primary">Account Information</h5>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" 
                                           id="password_confirmation" name="password_confirmation" required>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Academic Level -->
                            <h5 class="fw-bold mb-3 text-primary">Academic Information</h5>
                            
                            <div class="mb-3">
                                <label for="academic_level" class="form-label">Academic Level <span class="text-danger">*</span></label>
                                <select class="form-select @error('academic_level') is-invalid @enderror" 
                                        id="academic_level" name="academic_level" required>
                                    <option value="">Select Academic Level</option>
                                    <option value="Undergraduate" {{ old('academic_level') == 'Undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                                    <option value="MS" {{ old('academic_level') == 'MS' ? 'selected' : '' }}>MS</option>
                                    <option value="MPhil" {{ old('academic_level') == 'MPhil' ? 'selected' : '' }}>MPhil</option>
                                </select>
                                @error('academic_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                                <select class="form-select @error('department') is-invalid @enderror" 
                                        id="department" name="department" required>
                                    <option value="">Select Department</option>
                                    <option value="AI" {{ old('department') == 'AI' ? 'selected' : '' }}>AI Department</option>
                                    <option value="Software Engineering" {{ old('department') == 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
                                    <option value="Computer Science" {{ old('department') == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                                </select>
                                @error('department')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="profile_picture" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control @error('profile_picture') is-invalid @enderror" 
                                       id="profile_picture" name="profile_picture" accept="image/*">
                                @error('profile_picture')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <!-- Undergraduate Fields -->
                            <div id="undergraduate-fields" class="conditional-fields {{ old('academic_level') == 'Undergraduate' ? 'active' : '' }}">
                                <h5 class="fw-bold mb-3 text-success">Undergraduate Information</h5>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                                        <select class="form-select @error('semester') is-invalid @enderror" 
                                                id="semester" name="semester">
                                            <option value="">Select Semester</option>
                                            @for($i = 1; $i <= 8; $i++)
                                                <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('semester')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="section" class="form-label">Section <span class="text-danger">*</span></label>
                                        <select class="form-select @error('section') is-invalid @enderror" 
                                                id="section" name="section">
                                            <option value="">Select Section</option>
                                            <option value="A" {{ old('section') == 'A' ? 'selected' : '' }}>Section A</option>
                                            <option value="B" {{ old('section') == 'B' ? 'selected' : '' }}>Section B</option>
                                            <option value="C" {{ old('section') == 'C' ? 'selected' : '' }}>Section C</option>
                                        </select>
                                        @error('section')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="batch_year" class="form-label">Batch Year <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('batch_year') is-invalid @enderror" 
                                               id="batch_year" name="batch_year" value="{{ old('batch_year') }}" 
                                               min="2000" max="{{ date('Y') + 5 }}">
                                        @error('batch_year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="registration_number" class="form-label">Registration Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('registration_number') is-invalid @enderror" 
                                               id="registration_number" name="registration_number" value="{{ old('registration_number') }}">
                                        @error('registration_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="enrollment_status" class="form-label">Enrollment Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('enrollment_status') is-invalid @enderror" 
                                            id="enrollment_status" name="enrollment_status">
                                        <option value="">Select Status</option>
                                        <option value="Active" {{ old('enrollment_status') == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Graduated" {{ old('enrollment_status') == 'Graduated' ? 'selected' : '' }}>Graduated</option>
                                        <option value="On Hold" {{ old('enrollment_status') == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                                    </select>
                                    @error('enrollment_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- MS/MPhil Fields -->
                            <div id="graduate-fields" class="conditional-fields {{ in_array(old('academic_level'), ['MS', 'MPhil']) ? 'active' : '' }}">
                                <h5 class="fw-bold mb-3 text-info">Graduate Program Information</h5>
                                
                                <div class="mb-3">
                                    <label for="program_type" class="form-label">Program Type <span class="text-danger">*</span></label>
                                    <select class="form-select @error('program_type') is-invalid @enderror" 
                                            id="program_type" name="program_type">
                                        <option value="">Select Program</option>
                                        <option value="MS" {{ old('program_type') == 'MS' ? 'selected' : '' }}>MS</option>
                                        <option value="MPhil" {{ old('program_type') == 'MPhil' ? 'selected' : '' }}>MPhil</option>
                                    </select>
                                    @error('program_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="research_area" class="form-label">Research Area <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('research_area') is-invalid @enderror" 
                                           id="research_area" name="research_area" value="{{ old('research_area') }}" 
                                           placeholder="e.g., Machine Learning, Software Architecture">
                                    @error('research_area')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="supervisor" class="form-label">Supervisor (Optional)</label>
                                    <select class="form-select @error('supervisor') is-invalid @enderror" 
                                            id="supervisor" name="supervisor">
                                        <option value="">Select Supervisor</option>
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->name }}" 
                                                    data-department="{{ $teacher->department }}"
                                                    {{ old('supervisor') == $teacher->name ? 'selected' : '' }}>
                                                {{ $teacher->name }} ({{ $teacher->department }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('supervisor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="enrollment_year" class="form-label">Enrollment Year <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('enrollment_year') is-invalid @enderror" 
                                               id="enrollment_year" name="enrollment_year" value="{{ old('enrollment_year') }}" 
                                               min="2000" max="{{ date('Y') + 1 }}">
                                        @error('enrollment_year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="study_status" class="form-label">Study Status <span class="text-danger">*</span></label>
                                        <select class="form-select @error('study_status') is-invalid @enderror" 
                                                id="study_status" name="study_status">
                                            <option value="">Select Status</option>
                                            <option value="Coursework" {{ old('study_status') == 'Coursework' ? 'selected' : '' }}>Coursework</option>
                                            <option value="Research" {{ old('study_status') == 'Research' ? 'selected' : '' }}>Research</option>
                                            <option value="Thesis Submitted" {{ old('study_status') == 'Thesis Submitted' ? 'selected' : '' }}>Thesis Submitted</option>
                                        </select>
                                        @error('study_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Register as Student</button>
                                <a href="{{ url('/') }}" class="btn btn-outline-secondary">Back to Home</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('frontend-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const academicLevel = document.getElementById('academic_level');
    const undergraduateFields = document.getElementById('undergraduate-fields');
    const graduateFields = document.getElementById('graduate-fields');
    const department = document.getElementById('department');
    const supervisor = document.getElementById('supervisor');

    // Toggle fields based on academic level
    academicLevel.addEventListener('change', function() {
        undergraduateFields.classList.remove('active');
        graduateFields.classList.remove('active');

        if (this.value === 'Undergraduate') {
            undergraduateFields.classList.add('active');
        } else if (this.value === 'MS' || this.value === 'MPhil') {
            graduateFields.classList.add('active');
        }
    });

    // Filter supervisors by department
    department.addEventListener('change', function() {
        const selectedDept = this.value;
        const options = supervisor.querySelectorAll('option');
        
        options.forEach(option => {
            if (option.value === '') {
                option.style.display = 'block';
                return;
            }
            
            const optionDept = option.getAttribute('data-department');
            if (optionDept === selectedDept || !selectedDept) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });
        
        supervisor.value = '';
    });
});
</script>
@endpush
