@extends('frontend.layouts.frontend')

@section('meta_title', 'Teacher Registration')

@section('frontend-content')

<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold">Teacher Registration</h2>
                            <p class="text-muted">Join our faculty team</p>
                        </div>

                        <form method="POST" action="{{ url('/register/teacher') }}" enctype="multipart/form-data">
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

                            <!-- Department Selection -->
                            <h5 class="fw-bold mb-3 text-primary">Department Selection</h5>
                            
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

                            <hr class="my-4">

                            <!-- Basic Information -->
                            <h5 class="fw-bold mb-3 text-primary">Basic Information</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cnic" class="form-label">CNIC / Employee ID <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('cnic') is-invalid @enderror" 
                                           id="cnic" name="cnic" value="{{ old('cnic') }}" required>
                                    @error('cnic')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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

                            <!-- Professional Information -->
                            <h5 class="fw-bold mb-3 text-primary">Professional Information</h5>
                            
                            <div class="mb-3">
                                <label for="designation" class="form-label">Rank / Designation <span class="text-danger">*</span></label>
                                <select class="form-select @error('designation') is-invalid @enderror" 
                                        id="designation" name="designation" required>
                                    <option value="">Select Designation</option>
                                    <option value="HOD" {{ old('designation') == 'HOD' ? 'selected' : '' }}>HOD</option>
                                    <option value="Dean" {{ old('designation') == 'Dean' ? 'selected' : '' }}>Dean</option>
                                    <option value="Professor" {{ old('designation') == 'Professor' ? 'selected' : '' }}>Professor</option>
                                    <option value="Associate Professor" {{ old('designation') == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                                    <option value="Assistant Professor" {{ old('designation') == 'Assistant Professor' ? 'selected' : '' }}>Assistant Professor</option>
                                    <option value="Lecturer" {{ old('designation') == 'Lecturer' ? 'selected' : '' }}>Lecturer</option>
                                    <option value="Visiting Faculty" {{ old('designation') == 'Visiting Faculty' ? 'selected' : '' }}>Visiting Faculty</option>
                                </select>
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Subjects Teaching</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="subjects_teaching[]" value="Data Structures" id="sub1">
                                            <label class="form-check-label" for="sub1">Data Structures</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="subjects_teaching[]" value="Algorithms" id="sub2">
                                            <label class="form-check-label" for="sub2">Algorithms</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="subjects_teaching[]" value="Database Systems" id="sub3">
                                            <label class="form-check-label" for="sub3">Database Systems</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="subjects_teaching[]" value="Operating Systems" id="sub4">
                                            <label class="form-check-label" for="sub4">Operating Systems</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="subjects_teaching[]" value="Machine Learning" id="sub5">
                                            <label class="form-check-label" for="sub5">Machine Learning</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="subjects_teaching[]" value="Software Engineering" id="sub6">
                                            <label class="form-check-label" for="sub6">Software Engineering</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="subjects_teaching[]" value="Web Development" id="sub7">
                                            <label class="form-check-label" for="sub7">Web Development</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="subjects_teaching[]" value="Computer Networks" id="sub8">
                                            <label class="form-check-label" for="sub8">Computer Networks</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="office_location" class="form-label">Office Location</label>
                                    <input type="text" class="form-control @error('office_location') is-invalid @enderror" 
                                           id="office_location" name="office_location" value="{{ old('office_location') }}">
                                    @error('office_location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="office_timings" class="form-label">Office Timings</label>
                                    <input type="text" class="form-control @error('office_timings') is-invalid @enderror" 
                                           id="office_timings" name="office_timings" value="{{ old('office_timings') }}" 
                                           placeholder="e.g., 9:00 AM - 5:00 PM">
                                    @error('office_timings')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="date_of_joining" class="form-label">Date of Joining <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('date_of_joining') is-invalid @enderror" 
                                           id="date_of_joining" name="date_of_joining" value="{{ old('date_of_joining') }}" required>
                                    @error('date_of_joining')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="On Leave" {{ old('status') == 'On Leave' ? 'selected' : '' }}>On Leave</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Register as Teacher</button>
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
