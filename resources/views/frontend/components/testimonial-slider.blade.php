<!-- Testimonials Section -->
<section class="testimonials-section py-5 bg-light-blue">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">What Our Patients Say</h2>
            <p class="section-subtitle">Real experiences from real patients</p>
        </div>

        <div class="testimonial-slider">
            @forelse($testimonials as $testimonial)
            <div class="testimonial-item">
                <div class="testimonial-card">
                    <!-- Rating Stars -->
                    <div class="testimonial-rating">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $testimonial->rating)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>

                    <!-- Testimonial Text -->
                    <p class="testimonial-text">
                        "{{ $testimonial->content }}"
                    </p>

                    <!-- Author Info -->
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">
                            @if($testimonial->image)
                                <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}" class="w-100 h-100 rounded-circle object-fit-cover">
                            @else
                                {{ substr($testimonial->name, 0, 1) }}
                            @endif
                        </div>
                        <div>
                            <p class="testimonial-name mb-0">{{ $testimonial->name }}</p>
                            <small class="text-muted">Verified Patient</small>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <!-- Default Testimonials if none in database -->
            <div class="testimonial-item">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "Excellent service! The staff was friendly and professional. My teeth cleaning was thorough and painless. Highly recommend!"
                    </p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">J</div>
                        <div>
                            <p class="testimonial-name mb-0">John Smith</p>
                            <small class="text-muted">Verified Patient</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="testimonial-item">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "Dr. Sarah is amazing! She made me feel comfortable during my root canal treatment. The clinic is clean and modern."
                    </p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">M</div>
                        <div>
                            <p class="testimonial-name mb-0">Maria Garcia</p>
                            <small class="text-muted">Verified Patient</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="testimonial-item">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "I got my teeth whitened here and the results are fantastic! Very happy with the service and the friendly staff."
                    </p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">D</div>
                        <div>
                            <p class="testimonial-name mb-0">David Lee</p>
                            <small class="text-muted">Verified Patient</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="testimonial-item">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "Best dental experience ever! The team is professional, caring, and the facility is top-notch. Highly recommended!"
                    </p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">S</div>
                        <div>
                            <p class="testimonial-name mb-0">Sarah Johnson</p>
                            <small class="text-muted">Verified Patient</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

@push('frontend-scripts')
<script>
$(document).ready(function(){
    $('.testimonial-slider').slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false
                }
            }
        ]
    });
});
</script>

<style>
/* Slick Slider Custom Arrows */
.testimonial-slider .slick-prev,
.testimonial-slider .slick-next {
    width: 40px;
    height: 40px;
    background: white;
    border-radius: 50%;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    z-index: 10;
    transition: all 0.3s ease;
}

.testimonial-slider .slick-prev:hover,
.testimonial-slider .slick-next:hover {
    background: var(--primary-blue);
}

.testimonial-slider .slick-prev:hover i,
.testimonial-slider .slick-next:hover i {
    color: white;
}

.testimonial-slider .slick-prev {
    left: -50px;
}

.testimonial-slider .slick-next {
    right: -50px;
}

.testimonial-slider .slick-prev i,
.testimonial-slider .slick-next i {
    color: var(--primary-blue);
    font-size: 16px;
}

.testimonial-slider .slick-dots {
    bottom: -40px;
}

.testimonial-slider .slick-dots li button:before {
    font-size: 12px;
    color: var(--primary-blue);
}

.testimonial-slider .slick-dots li.slick-active button:before {
    color: var(--primary-blue);
    opacity: 1;
}

@media (max-width: 1200px) {
    .testimonial-slider .slick-prev {
        left: -30px;
    }
    
    .testimonial-slider .slick-next {
        right: -30px;
    }
}

@media (max-width: 768px) {
    .testimonial-slider .slick-prev,
    .testimonial-slider .slick-next {
        display: none !important;
    }
}
</style>
@endpush
