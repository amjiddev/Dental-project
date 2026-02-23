@extends('frontend.layouts.frontend')

@section('meta_title', 'Privacy Policy - Manji Dental')
@section('meta_description', 'Read our privacy policy to understand how we protect your personal information.')

@section('frontend-content')

<!-- Page Header -->
<section class="bg-gradient-blue text-white py-5">
    <div class="container py-4">
        <div class="text-center" data-aos="fade-up">
            <h1 class="display-4 fw-bold mb-3 text-white">Privacy Policy</h1>
            <p class="lead mb-0">Your privacy is important to us</p>
        </div>
    </div>
</section>

<!-- Privacy Content -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up">
                <div class="card border-0 shadow-sm p-4">
                    <div class="card-body">
                        <h2 class="h4 fw-bold mb-4 text-primary">1. Information We Collect</h2>
                        <p class="text-muted mb-4">
                            We collect personal information that you provide to us, including your name, contact details, medical history, and insurance information. This information is necessary to provide you with quality dental care.
                        </p>

                        <h2 class="h4 fw-bold mb-4 text-primary">2. How We Use Your Information</h2>
                        <p class="text-muted mb-4">
                            Your information is used to:
                        </p>
                        <ul class="text-muted mb-4">
                            <li>Provide dental treatment and care</li>
                            <li>Schedule and manage appointments</li>
                            <li>Process payments and insurance claims</li>
                            <li>Send appointment reminders and follow-up communications</li>
                            <li>Improve our services and patient experience</li>
                        </ul>

                        <h2 class="h4 fw-bold mb-4 text-primary">3. Information Sharing</h2>
                        <p class="text-muted mb-4">
                            We do not sell, trade, or rent your personal information to third parties. We may share your information with:
                        </p>
                        <ul class="text-muted mb-4">
                            <li>Healthcare providers involved in your treatment</li>
                            <li>Insurance companies for claims processing</li>
                            <li>Legal authorities when required by law</li>
                            <li>Service providers who assist in our operations (under strict confidentiality agreements)</li>
                        </ul>

                        <h2 class="h4 fw-bold mb-4 text-primary">4. Data Security</h2>
                        <p class="text-muted mb-4">
                            We implement appropriate security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction. This includes physical, electronic, and procedural safeguards.
                        </p>

                        <h2 class="h4 fw-bold mb-4 text-primary">5. Your Rights</h2>
                        <p class="text-muted mb-4">
                            You have the right to:
                        </p>
                        <ul class="text-muted mb-4">
                            <li>Access your personal information</li>
                            <li>Request corrections to your information</li>
                            <li>Request deletion of your information (subject to legal requirements)</li>
                            <li>Opt-out of marketing communications</li>
                            <li>File a complaint with relevant authorities</li>
                        </ul>

                        <h2 class="h4 fw-bold mb-4 text-primary">6. Cookies and Tracking</h2>
                        <p class="text-muted mb-4">
                            Our website uses cookies to enhance your browsing experience. You can control cookie settings through your browser preferences.
                        </p>

                        <h2 class="h4 fw-bold mb-4 text-primary">7. Children's Privacy</h2>
                        <p class="text-muted mb-4">
                            We do not knowingly collect personal information from children under 13 without parental consent. If you believe we have collected such information, please contact us immediately.
                        </p>

                        <h2 class="h4 fw-bold mb-4 text-primary">8. Changes to Privacy Policy</h2>
                        <p class="text-muted mb-4">
                            We may update this privacy policy from time to time. We will notify you of any significant changes by posting the new policy on our website.
                        </p>

                        <h2 class="h4 fw-bold mb-4 text-primary">9. Contact Us</h2>
                        <p class="text-muted mb-0">
                            If you have any questions about this Privacy Policy or how we handle your information, please contact us at:
                        </p>
                        <ul class="text-muted mb-0 mt-3">
                            <li>Email: info@manjidental.com</li>
                            <li>Phone: +92 300 1234567</li>
                            <li>Address: 123 Main Street, Lahore, Pakistan</li>
                        </ul>
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
