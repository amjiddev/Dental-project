@extends('frontend.layouts.frontend')

@section('meta_title', 'Terms & Conditions - Manji Dental')
@section('meta_description', 'Read our terms and conditions for using our dental services.')

@section('frontend-content')

<!-- Page Header -->
<section class="bg-gradient-blue text-white py-5">
    <div class="container py-4">
        <div class="text-center" data-aos="fade-up">
            <h1 class="display-4 fw-bold mb-3 text-white">Terms & Conditions</h1>
            <p class="lead mb-0">Please read these terms carefully before using our services</p>
        </div>
    </div>
</section>

<!-- Terms Content -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up">
                <div class="card border-0 shadow-sm p-4">
                    <div class="card-body">
                        <h2 class="h4 fw-bold mb-4 text-primary">1. Acceptance of Terms</h2>
                        <p class="text-muted mb-4">
                            By accessing and using the services of Qasmi Dental & Aesthetic Centre, you accept and agree to be bound by the terms and provision of this agreement.
                        </p>

                        <h2 class="h4 fw-bold mb-4 text-primary">2. Appointment Policy</h2>
                        <p class="text-muted mb-4">
                            All appointments must be scheduled in advance. We require at least 24 hours notice for cancellations or rescheduling. Failure to provide adequate notice may result in a cancellation fee.
                        </p>

                        <h2 class="h4 fw-bold mb-4 text-primary">3. Payment Terms</h2>
                        <p class="text-muted mb-4">
                            Payment is due at the time of service unless prior arrangements have been made. We accept cash, credit cards, and bank transfers. Insurance claims must be processed according to your insurance provider's requirements.
                        </p>

                        <h2 class="h4 fw-bold mb-4 text-primary">4. Treatment Consent</h2>
                        <p class="text-muted mb-4">
                            All patients must provide informed consent before any treatment. Our dental professionals will explain all procedures, risks, and alternatives before beginning treatment.
                        </p>

                        <h2 class="h4 fw-bold mb-4 text-primary">5. Patient Responsibilities</h2>
                        <p class="text-muted mb-4">
                            Patients are responsible for providing accurate medical history, following post-treatment instructions, and attending follow-up appointments as recommended.
                        </p>

                        <h2 class="h4 fw-bold mb-4 text-primary">6. Privacy & Confidentiality</h2>
                        <p class="text-muted mb-4">
                            We maintain strict confidentiality of all patient information in accordance with applicable privacy laws and regulations. Please refer to our Privacy Policy for more details.
                        </p>

                        <h2 class="h4 fw-bold mb-4 text-primary">7. Limitation of Liability</h2>
                        <p class="text-muted mb-4">
                            While we strive to provide the highest quality care, we cannot guarantee specific results. Our liability is limited to the cost of the services provided.
                        </p>

                        <h2 class="h4 fw-bold mb-4 text-primary">8. Changes to Terms</h2>
                        <p class="text-muted mb-4">
                            We reserve the right to modify these terms at any time. Changes will be effective immediately upon posting on our website.
                        </p>

                        <h2 class="h4 fw-bold mb-4 text-primary">9. Contact Information</h2>
                        <p class="text-muted mb-0">
                            If you have any questions about these Terms & Conditions, please contact us at info@manjidental.com or call +92 300 1234567.
                        </p>
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
</script>
@endpush
