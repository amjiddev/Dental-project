<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Doctor;
use App\Models\Testimonial;
use App\Models\BlogPost;
use App\Models\Setting;

class DentalClinicSeeder extends Seeder
{
    public function run()
    {
        // Services
        $services = [
            [
                'name' => 'Teeth Cleaning',
                'slug' => 'teeth-cleaning',
                'short_description' => 'Professional dental cleaning to remove plaque and tartar',
                'description' => 'Regular teeth cleaning is essential for maintaining good oral health. Our professional cleaning service removes plaque, tartar, and stains, leaving your teeth clean and healthy.',
                'icon' => 'fas fa-tooth',
                'price' => 80.00,
                'duration_minutes' => 30,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Teeth Whitening',
                'slug' => 'teeth-whitening',
                'short_description' => 'Professional whitening for a brighter smile',
                'description' => 'Get a brighter, whiter smile with our professional teeth whitening service. Safe and effective treatment that can lighten your teeth by several shades.',
                'icon' => 'fas fa-smile',
                'price' => 350.00,
                'duration_minutes' => 60,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Dental Implants',
                'slug' => 'dental-implants',
                'short_description' => 'Permanent solution for missing teeth',
                'description' => 'Dental implants are a permanent solution for missing teeth. They look, feel, and function like natural teeth, providing a long-lasting solution.',
                'icon' => 'fas fa-teeth',
                'price' => 2500.00,
                'duration_minutes' => 120,
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Root Canal Treatment',
                'slug' => 'root-canal-treatment',
                'short_description' => 'Save infected teeth with root canal therapy',
                'description' => 'Root canal treatment can save a tooth that has been infected or severely damaged. Our experienced dentists use modern techniques to make the procedure comfortable.',
                'icon' => 'fas fa-tooth',
                'price' => 800.00,
                'duration_minutes' => 90,
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Orthodontics (Braces)',
                'slug' => 'orthodontics-braces',
                'short_description' => 'Straighten your teeth with braces',
                'description' => 'Orthodontic treatment can correct misaligned teeth and improve your smile. We offer traditional braces and modern clear aligners.',
                'icon' => 'fas fa-teeth-open',
                'price' => 3500.00,
                'duration_minutes' => 45,
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'Dental Crowns',
                'slug' => 'dental-crowns',
                'short_description' => 'Restore damaged teeth with crowns',
                'description' => 'Dental crowns are custom-made caps that cover damaged or weakened teeth, restoring their shape, size, and strength.',
                'icon' => 'fas fa-crown',
                'price' => 1200.00,
                'duration_minutes' => 60,
                'is_active' => true,
                'order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // Doctors
        $doctors = [
            [
                'name' => 'Dr. Sarah Johnson',
                'specialization' => 'General Dentistry',
                'qualification' => 'DDS, MSD',
                'bio' => 'Dr. Sarah Johnson has over 15 years of experience in general dentistry. She is passionate about providing comprehensive dental care and helping patients achieve optimal oral health.',
                'email' => 'sarah.johnson@dentalclinic.com',
                'phone' => '+1 (555) 123-4567',
                'experience_years' => 15,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Dr. Michael Chen',
                'specialization' => 'Orthodontist',
                'qualification' => 'DDS, MS Orthodontics',
                'bio' => 'Dr. Michael Chen specializes in orthodontics and has helped thousands of patients achieve beautiful, straight smiles through braces and clear aligners.',
                'email' => 'michael.chen@dentalclinic.com',
                'phone' => '+1 (555) 234-5678',
                'experience_years' => 12,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Dr. Emily Rodriguez',
                'specialization' => 'Cosmetic Dentistry',
                'qualification' => 'DDS, AAACD',
                'bio' => 'Dr. Emily Rodriguez is an expert in cosmetic dentistry, specializing in teeth whitening, veneers, and smile makeovers. She combines artistry with dental science.',
                'email' => 'emily.rodriguez@dentalclinic.com',
                'phone' => '+1 (555) 345-6789',
                'experience_years' => 10,
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Dr. James Wilson',
                'specialization' => 'Endodontist',
                'qualification' => 'DDS, MS Endodontics',
                'bio' => 'Dr. James Wilson specializes in root canal treatments and has extensive experience in saving teeth through advanced endodontic procedures.',
                'email' => 'james.wilson@dentalclinic.com',
                'phone' => '+1 (555) 456-7890',
                'experience_years' => 18,
                'is_active' => true,
                'order' => 4,
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }

        // Testimonials
        $testimonials = [
            [
                'name' => 'John Smith',
                'content' => 'Excellent service! The staff was friendly and professional. My teeth cleaning was thorough and painless. Highly recommend!',
                'rating' => 5,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Maria Garcia',
                'content' => 'Dr. Sarah Johnson is amazing! She made me feel comfortable during my root canal treatment. The clinic is clean and modern.',
                'rating' => 5,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'David Lee',
                'content' => 'I got my teeth whitened here and the results are fantastic! Very happy with the service and the friendly staff.',
                'rating' => 5,
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }

        // Blog Posts
        $blogPosts = [
            [
                'title' => '5 Tips for Maintaining Healthy Teeth',
                'slug' => '5-tips-for-maintaining-healthy-teeth',
                'excerpt' => 'Learn the essential tips for keeping your teeth healthy and strong.',
                'content' => 'Maintaining healthy teeth is crucial for overall health. Here are 5 essential tips: 1. Brush twice daily, 2. Floss regularly, 3. Visit your dentist every 6 months, 4. Limit sugary foods, 5. Use fluoride toothpaste.',
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'The Benefits of Regular Dental Checkups',
                'slug' => 'benefits-of-regular-dental-checkups',
                'excerpt' => 'Discover why regular dental visits are important for your oral health.',
                'content' => 'Regular dental checkups help prevent cavities, gum disease, and other oral health issues. Early detection of problems can save you time, money, and discomfort.',
                'is_published' => true,
                'published_at' => now()->subDays(7),
            ],
        ];

        foreach ($blogPosts as $post) {
            BlogPost::create($post);
        }

        // Settings
        $settings = [
            ['key' => 'clinic_name', 'value' => 'Dental Clinic'],
            ['key' => 'clinic_email', 'value' => 'info@dentalclinic.com'],
            ['key' => 'clinic_phone', 'value' => '+1 (555) 123-4567'],
            ['key' => 'clinic_address', 'value' => '123 Main Street, City, State 12345'],
            ['key' => 'whatsapp_number', 'value' => '+1234567890'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/dentalclinic'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/dentalclinic'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/dentalclinic'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
