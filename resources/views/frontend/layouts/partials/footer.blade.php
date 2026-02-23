<footer class="bg-gradient-primary text-white py-5 mt-5">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-tooth me-2"></i>Dental Clinic
                </h5>
                <p class="text-white-75 mb-3">
                    Your trusted partner for comprehensive dental care. We provide quality dental services with a focus on patient comfort and satisfaction.
                </p>
                <div class="social-links">
                    <a href="https://facebook.com" target="_blank" class="btn btn-light btn-sm rounded-circle me-2" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank" class="btn btn-light btn-sm rounded-circle me-2" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://twitter.com" target="_blank" class="btn btn-light btn-sm rounded-circle me-2" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://linkedin.com" target="_blank" class="btn btn-light btn-sm rounded-circle" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">Quick Links</h5>
                <ul class="list-unstyled footer-links">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-white-75 text-decoration-none hover-link">Home</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}" class="text-white-75 text-decoration-none hover-link">About Us</a></li>
                    <li class="mb-2"><a href="{{ route('team') }}" class="text-white-75 text-decoration-none hover-link">Our Team</a></li>
                    <li class="mb-2"><a href="{{ route('discounts') }}" class="text-white-75 text-decoration-none hover-link">Discounts</a></li>
                    <li class="mb-2"><a href="{{ route('gallery') }}" class="text-white-75 text-decoration-none hover-link">Gallery</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">Our Services</h5>
                <ul class="list-unstyled footer-links">
                    <li class="mb-2"><a href="{{ route('services.operative') }}" class="text-white-75 text-decoration-none hover-link">Operative Dentistry</a></li>
                    <li class="mb-2"><a href="{{ route('services.endodontics') }}" class="text-white-75 text-decoration-none hover-link">Endodontics</a></li>
                    <li class="mb-2"><a href="{{ route('services.periodontics') }}" class="text-white-75 text-decoration-none hover-link">Periodontics</a></li>
                    <li class="mb-2"><a href="{{ route('services.orthodontics') }}" class="text-white-75 text-decoration-none hover-link">Orthodontics</a></li>
                    <li class="mb-2"><a href="{{ route('services.prosthodontics') }}" class="text-white-75 text-decoration-none hover-link">Prosthodontics</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">Contact Us</h5>
                <ul class="list-unstyled text-white-75">
                    <li class="mb-3">
                        <i class="fas fa-map-marker-alt me-2 text-white"></i>
                        123 Main Street<br>
                        <span class="ms-4">City, State 12345</span>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-phone me-2 text-white"></i>
                        <a href="tel:+15551234567" class="text-white-75 text-decoration-none hover-link">+1 (555) 123-4567</a>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-envelope me-2 text-white"></i>
                        <a href="mailto:info@dentalclinic.com" class="text-white-75 text-decoration-none hover-link">info@dentalclinic.com</a>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-clock me-2 text-white"></i>
                        Mon - Fri: 9:00 AM - 6:00 PM<br>
                        <span class="ms-4">Sat: 9:00 AM - 2:00 PM</span>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="bg-white opacity-25 my-4">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="mb-0 text-white-75">
                    &copy; {{ date('Y') }} Dental Clinic. All Rights Reserved.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="{{ route('terms') }}" class="text-white-75 text-decoration-none hover-link me-3">Terms & Conditions</a>
                <a href="{{ route('privacy') }}" class="text-white-75 text-decoration-none hover-link">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/1234567890" target="_blank" class="whatsapp-float" title="Chat on WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<style>
/* Footer Styles */
.bg-gradient-primary {
    background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
}

.text-white-75 {
    color: rgba(255, 255, 255, 0.75);
}

.footer-links a.hover-link:hover {
    color: #fff !important;
    padding-left: 5px;
    transition: all 0.3s ease;
}

.social-links .btn {
    width: 36px;
    height: 36px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.social-links .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* WhatsApp Floating Button */
.whatsapp-float {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 30px;
    right: 30px;
    background-color: #25d366;
    color: #FFF;
    border-radius: 50px;
    text-align: center;
    font-size: 30px;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.whatsapp-float:hover {
    background-color: #128c7e;
    color: #FFF;
    transform: scale(1.1);
    box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.4);
}

.whatsapp-float i {
    margin-top: 0;
}

@media (max-width: 768px) {
    .whatsapp-float {
        width: 50px;
        height: 50px;
        font-size: 25px;
        bottom: 20px;
        right: 20px;
    }
}
</style>
