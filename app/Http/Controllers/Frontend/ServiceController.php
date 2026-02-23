<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function operative()
    {
        $service = [
            'title' => 'Operative (Restorative & Cosmetic)',
            'description' => 'Comprehensive restorative and cosmetic dental treatments to restore and enhance your smile.',
            'icon' => 'fas fa-tooth',
            'treatments' => [
                [
                    'name' => 'Dental Fillings',
                    'description' => 'Tooth-colored composite fillings to restore decayed or damaged teeth',
                    'image' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Teeth Whitening',
                    'description' => 'Professional whitening treatments for a brighter, whiter smile',
                    'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Dental Veneers',
                    'description' => 'Porcelain veneers to correct chips, gaps, and discoloration',
                    'image' => 'https://images.unsplash.com/photo-1609840114035-3c981960afdd?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Bonding',
                    'description' => 'Cosmetic bonding to repair minor imperfections',
                    'image' => 'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=400&h=300&fit=crop'
                ]
            ]
        ];
        
        return view('frontend.services.detail', compact('service'));
    }

    public function endodontics()
    {
        $service = [
            'title' => 'Endodontics',
            'description' => 'Specialized root canal treatments to save infected or damaged teeth and relieve pain.',
            'icon' => 'fas fa-syringe',
            'treatments' => [
                [
                    'name' => 'Root Canal Treatment',
                    'description' => 'Advanced root canal therapy to save infected teeth',
                    'image' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Pulp Therapy',
                    'description' => 'Treatment for damaged or infected tooth pulp',
                    'image' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Apicoectomy',
                    'description' => 'Surgical removal of tooth root tip to treat persistent infection',
                    'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=400&h=300&fit=crop'
                ]
            ]
        ];
        
        return view('frontend.services.detail', compact('service'));
    }

    public function oralSurgery()
    {
        $service = [
            'title' => 'Oral & Maxillofacial Surgery',
            'description' => 'Expert surgical procedures for complex dental and facial conditions.',
            'icon' => 'fas fa-user-md',
            'treatments' => [
                [
                    'name' => 'Tooth Extraction',
                    'description' => 'Safe and painless removal of damaged or problematic teeth',
                    'image' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Wisdom Teeth Removal',
                    'description' => 'Surgical extraction of impacted wisdom teeth',
                    'image' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Jaw Surgery',
                    'description' => 'Corrective surgery for jaw alignment and TMJ disorders',
                    'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Bone Grafting',
                    'description' => 'Bone augmentation for dental implant preparation',
                    'image' => 'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=400&h=300&fit=crop'
                ]
            ]
        ];
        
        return view('frontend.services.detail', compact('service'));
    }

    public function prosthodontics()
    {
        $service = [
            'title' => 'Prosthodontics',
            'description' => 'Restoration and replacement of missing or damaged teeth with prosthetic devices.',
            'icon' => 'fas fa-teeth',
            'treatments' => [
                [
                    'name' => 'Dental Crowns',
                    'description' => 'Custom-made crowns to restore damaged teeth',
                    'image' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Dental Bridges',
                    'description' => 'Fixed bridges to replace missing teeth',
                    'image' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Dentures',
                    'description' => 'Complete or partial dentures for missing teeth',
                    'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Implant Supported Prosthetics',
                    'description' => 'Permanent tooth replacement with dental implants',
                    'image' => 'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=400&h=300&fit=crop'
                ]
            ]
        ];
        
        return view('frontend.services.detail', compact('service'));
    }

    public function periodontics()
    {
        $service = [
            'title' => 'Periodontics & Implantology',
            'description' => 'Treatment of gum disease and placement of dental implants for permanent tooth replacement.',
            'icon' => 'fas fa-teeth-open',
            'treatments' => [
                [
                    'name' => 'Gum Disease Treatment',
                    'description' => 'Comprehensive treatment for gingivitis and periodontitis',
                    'image' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Dental Implants',
                    'description' => 'Permanent tooth replacement with titanium implants',
                    'image' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Gum Grafting',
                    'description' => 'Surgical procedure to restore receding gums',
                    'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Scaling & Root Planing',
                    'description' => 'Deep cleaning to remove plaque and tartar below gum line',
                    'image' => 'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=400&h=300&fit=crop'
                ]
            ]
        ];
        
        return view('frontend.services.detail', compact('service'));
    }

    public function orthodontics()
    {
        $service = [
            'title' => 'Orthodontics',
            'description' => 'Correction of misaligned teeth and jaws using braces and aligners.',
            'icon' => 'fas fa-smile',
            'treatments' => [
                [
                    'name' => 'Metal Braces',
                    'description' => 'Traditional metal braces for effective teeth straightening',
                    'image' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Ceramic Braces',
                    'description' => 'Tooth-colored braces for a more aesthetic appearance',
                    'image' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Clear Aligners',
                    'description' => 'Invisible aligners for discreet teeth straightening',
                    'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Retainers',
                    'description' => 'Custom retainers to maintain teeth alignment after treatment',
                    'image' => 'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=400&h=300&fit=crop'
                ]
            ]
        ];
        
        return view('frontend.services.detail', compact('service'));
    }

    public function pedodontics()
    {
        $service = [
            'title' => 'Pedodontics',
            'description' => 'Specialized dental care for infants, children, and adolescents.',
            'icon' => 'fas fa-child',
            'treatments' => [
                [
                    'name' => 'Pediatric Dental Exams',
                    'description' => 'Comprehensive dental checkups for children',
                    'image' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Fluoride Treatment',
                    'description' => 'Protective fluoride applications to prevent cavities',
                    'image' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Dental Sealants',
                    'description' => 'Protective coatings to prevent tooth decay in children',
                    'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Pulp Therapy for Kids',
                    'description' => 'Gentle treatment for infected baby teeth',
                    'image' => 'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=400&h=300&fit=crop'
                ]
            ]
        ];
        
        return view('frontend.services.detail', compact('service'));
    }

    public function oralMedicine()
    {
        $service = [
            'title' => 'Oral Medicine & Diagnostic Science',
            'description' => 'Diagnosis and treatment of oral diseases and conditions affecting the mouth.',
            'icon' => 'fas fa-microscope',
            'treatments' => [
                [
                    'name' => 'Oral Cancer Screening',
                    'description' => 'Early detection and diagnosis of oral cancer',
                    'image' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'TMJ Disorder Treatment',
                    'description' => 'Treatment for temporomandibular joint disorders',
                    'image' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Oral Lesion Management',
                    'description' => 'Diagnosis and treatment of mouth sores and lesions',
                    'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=400&h=300&fit=crop'
                ],
                [
                    'name' => 'Diagnostic Imaging',
                    'description' => 'Advanced imaging for accurate diagnosis',
                    'image' => 'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=400&h=300&fit=crop'
                ]
            ]
        ];
        
        return view('frontend.services.detail', compact('service'));
    }
}
