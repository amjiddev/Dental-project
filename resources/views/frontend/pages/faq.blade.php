@extends('frontend.layouts.frontend')

@section('title', 'FAQ - Frequently Asked Questions')
@section('meta_description', 'Find answers to commonly asked questions about our dental services.')

@section('content')

<!-- Page Header -->
<section class="dental-blue text-white py-16">
    <div class="container mx-auto px-4">
        <div class="text-center" data-aos="fade-up">
            <h1 class="text-5xl font-bold mb-4">Frequently Asked Questions</h1>
            <p class="text-xl text-blue-100">Find answers to common questions about our services</p>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up">
                    <button class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-gray-50 transition" onclick="toggleFaq(this)">
                        <span class="text-xl font-bold">How often should I visit the dentist?</span>
                        <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                    </button>
                    <div class="px-8 pb-6 hidden">
                        <p class="text-gray-600">We recommend visiting the dentist every 6 months for a routine check-up and cleaning. However, some patients may need more frequent visits depending on their oral health condition.</p>
                    </div>
                </div>
                
                <!-- FAQ Item 2 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <button class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-gray-50 transition" onclick="toggleFaq(this)">
                        <span class="text-xl font-bold">Do you accept insurance?</span>
                        <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                    </button>
                    <div class="px-8 pb-6 hidden">
                        <p class="text-gray-600">Yes, we accept most major dental insurance plans. Please contact our office with your insurance information, and we'll verify your coverage and benefits.</p>
                    </div>
                </div>
                
                <!-- FAQ Item 3 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <button class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-gray-50 transition" onclick="toggleFaq(this)">
                        <span class="text-xl font-bold">What should I do in a dental emergency?</span>
                        <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                    </button>
                    <div class="px-8 pb-6 hidden">
                        <p class="text-gray-600">For dental emergencies, call our office immediately. We offer emergency appointments and will do our best to see you as soon as possible. If it's after hours, leave a message and we'll get back to you promptly.</p>
                    </div>
                </div>
                
                <!-- FAQ Item 4 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                    <button class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-gray-50 transition" onclick="toggleFaq(this)">
                        <span class="text-xl font-bold">Are dental X-rays safe?</span>
                        <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                    </button>
                    <div class="px-8 pb-6 hidden">
                        <p class="text-gray-600">Yes, dental X-rays are very safe. We use digital X-rays which emit significantly less radiation than traditional X-rays. The amount of radiation exposure is minimal and the benefits far outweigh any risks.</p>
                    </div>
                </div>
                
                <!-- FAQ Item 5 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="400">
                    <button class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-gray-50 transition" onclick="toggleFaq(this)">
                        <span class="text-xl font-bold">How long does a teeth whitening procedure take?</span>
                        <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                    </button>
                    <div class="px-8 pb-6 hidden">
                        <p class="text-gray-600">Professional teeth whitening typically takes about 60-90 minutes. You'll see immediate results, with teeth becoming several shades whiter in just one visit.</p>
                    </div>
                </div>
                
                <!-- FAQ Item 6 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="500">
                    <button class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-gray-50 transition" onclick="toggleFaq(this)">
                        <span class="text-xl font-bold">What payment methods do you accept?</span>
                        <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                    </button>
                    <div class="px-8 pb-6 hidden">
                        <p class="text-gray-600">We accept cash, credit cards (Visa, MasterCard, American Express), debit cards, and offer flexible payment plans for larger procedures.</p>
                    </div>
                </div>
            </div>
            
            <!-- Contact CTA -->
            <div class="mt-12 bg-white rounded-xl shadow-lg p-8 text-center" data-aos="fade-up">
                <h3 class="text-2xl font-bold mb-4">Still Have Questions?</h3>
                <p class="text-gray-600 mb-6">Feel free to contact us and we'll be happy to help</p>
                <a href="{{ route('frontend.contact') }}" class="bg-blue-600 text-white px-8 py-4 rounded-full font-bold hover:bg-blue-700 transition inline-block">
                    <i class="fas fa-envelope mr-2"></i>Contact Us
                </a>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
function toggleFaq(button) {
    const content = button.nextElementSibling;
    const icon = button.querySelector('i');
    
    content.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}
</script>
@endpush

@endsection
