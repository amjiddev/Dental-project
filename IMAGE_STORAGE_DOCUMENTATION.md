# Image Storage Documentation - Dental Project

> Complete reference for image storage locations, usage, and management across the entire Dental project

---

## 📁 Storage Architecture Overview

The project uses **two primary storage systems** for images:

1. **Laravel Storage (Symlinked)** - `storage/app/public/` → `public/storage/`
2. **Public Uploads** - `public/uploads/`

---

## 🗂️ Directory Structure

### 1. Laravel Storage System
**Path:** `storage/app/public/`  
**Public Access:** Via `public/storage/` symlink  
**URL Pattern:** `{{ asset('storage/...') }}`

```
storage/app/public/
└── profile-photos/         # User profile photos (via ProfileController)
```

#### Usage:
- **Model:** `User`
- **Field:** `profile_photo_path`
- **Storage Method:** `Storage::disk('public')->store('profile-photos', 'public')`
- **Access:** `{{ $user->profile_photo_url }}` or `{{ asset('storage/' . $user->profile_photo_path) }}`
- **Controller:** `ProfileController`

---

### 2. Public Uploads Directory
**Path:** `public/uploads/`  
**Direct Public Access:** Yes  
**URL Pattern:** `{{ asset('uploads/...') }}`

```
public/uploads/
├── about/                  # About us section images
├── doctors/                # Doctor profile images
├── expert-tips/            # Expert tips images
├── gallery/                # Gallery images
├── services/               # Service images
└── treatment-options/      # Treatment option images
```

---

## 📋 Model-Based Image Storage

### User Model
**File:** `app/Models/User.php`
```php
Field: profile_photo_path
Storage: storage/app/public/profile-photos/
Access: Storage::disk('public')
URL: asset('storage/' . $user->profile_photo_path)
```

### Doctor Model
**File:** `app/Models/Doctor.php`
```php
Field: image
Storage: public/uploads/doctors/
Method: Direct file upload with move()
URL: asset($doctor->image)
```

### Service Model
**File:** `app/Models/Service.php`
```php
Fields: icon, image
Storage: public/uploads/services/
Method: Direct file upload with move()
URL: asset($service->image)
```

### Gallery Model
**File:** `app/Models/Gallery.php`
```php
Field: image
Storage: public/uploads/gallery/
Method: Direct file upload with move()
URL: asset($gallery->image)
```

### ExpertTip Model
**File:** `app/Models/ExpertTip.php`
```php
Field: image
Storage: public/uploads/expert-tips/
Method: Direct file upload with move()
URL: asset($expertTip->image)
```

### TreatmentOption Model
**File:** `app/Models/TreatmentOption.php`
```php
Field: image
Storage: public/uploads/treatment-options/
Method: Direct file upload with move()
URL: asset($treatmentOption->image)
Controller: TreatmentOptionController
```

### Testimonial Model
**File:** `app/Models/Testimonial.php`
```php
Field: patient_image
Storage: public/uploads/testimonials/ (expected)
URL: asset($testimonial->patient_image)
```

### BlogPost Model
**File:** `app/Models/BlogPost.php`
```php
Field: featured_image
Storage: public/uploads/blog/ (expected)
URL: asset($blogPost->featured_image)
```

---

## 🎯 Settings System Images

**Managed by:** `SettingController`  
**Database:** `settings` table (key-value pairs)

### About Section
```php
Key: about_image
Storage: public/uploads/about/
Upload Method: SettingController@updateAbout
Access: asset($settings['about_image'])
```

### Home Hero Section
```php
Key: home_hero_image
Storage: public/uploads/home/
Upload Method: SettingController@updateHome
Access: asset($settings['home_hero_image'])
```

---

## 📤 Upload Methods by Controller

### ProfileController
**File:** `app/Http/Controllers/ProfileController.php`
```php
Storage Method: Storage::disk('public')->store('profile-photos', 'public')
Validation: 'image|max:2048'
Location: storage/app/public/profile-photos/
Delete Method: Storage::disk('public')->delete($path)
```

### TreatmentOptionController
**File:** `app/Http/Controllers/Admin/TreatmentOptionController.php`
```php
Storage Method: $request->file('image')->move($uploadPath, $imageName)
Validation: 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
Location: public/uploads/treatment-options/
Path Format: 'uploads/treatment-options/' . time() . '_' . $originalName
Delete Method: unlink(public_path($path))
```

### SettingController
**File:** `app/Http/Controllers/Admin/SettingController.php`
```php
Storage Method: $request->file('image')->move($uploadPath, $imageName)
Validation: 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
Locations:
  - About: public/uploads/about/
  - Home Hero: public/uploads/home/
Path Format: 'uploads/[section]/' . time() . '_' . $originalName
Delete Method: unlink(public_path($oldImage))
```

### DoctorController (Expected Pattern)
**File:** `app/Http/Controllers/Admin/DoctorController.php`
```php
Storage Method: Direct file upload
Location: public/uploads/doctors/
Validation: 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
```

### ServiceController (Expected Pattern)
**File:** `app/Http/Controllers/Admin/ServiceController.php`
```php
Storage Method: Direct file upload
Location: public/uploads/services/
Validation: 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
```

### GalleryController (Expected Pattern)
**File:** `app/Http/Controllers/Admin/GalleryController.php`
```php
Storage Method: Direct file upload
Location: public/uploads/gallery/
Validation: 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
```

---

## 🖼️ Static Assets

### Admin Theme Assets
**Location:** `public/assets/media/`
- Logos: `assets/media/logos/`
- Avatars (placeholders): `assets/media/avatars/`
- Auth images: `assets/media/auth/`
- SVG icons: `assets/media/svg/`

### Frontend Assets
**Location:** `public/frontend/`
- Frontend-specific images and assets

---

## 🔧 Configuration

### Filesystem Config
**File:** `config/filesystems.php`

```php
'default' => env('FILESYSTEM_DISK', 'local')

'disks' => [
    'local' => [
        'driver' => 'local',
        'root' => storage_path('app'),
    ],
    
    'public' => [
        'driver' => 'local',
        'root' => storage_path('app/public'),
        'url' => env('APP_URL').'/storage',
        'visibility' => 'public',
    ],
]
```

### Symbolic Link
**Command:** `php artisan storage:link`  
**Creates:** `public/storage` → `storage/app/public`

---

## 📝 Naming Conventions

### Uploaded Files
**Pattern:** `{timestamp}_{original_filename}`  
**Example:** `1698765432_doctor-profile.jpg`

### Database Storage
- **Laravel Storage:** Relative path (e.g., `profile-photos/image.jpg`)
- **Public Uploads:** Full path from public root (e.g., `uploads/doctors/image.jpg`)

---

## 🗑️ Image Deletion Patterns

### Storage Disk Method
```php
Storage::disk('public')->delete($user->profile_photo_path);
```

### Direct File Method
```php
if (file_exists(public_path($image->path))) {
    unlink(public_path($image->path));
}
```

---

## ✅ Best Practices

### Current Implementation
1. ✅ Profile photos use Laravel Storage with symlink
2. ✅ Admin uploads use public directory
3. ✅ Timestamped filenames prevent conflicts
4. ✅ Image validation (type, size)
5. ✅ Old image cleanup on update

### Recommendations
1. 🔄 **Consider migrating all uploads to Laravel Storage** for consistency
2. 🔄 **Use UUID filenames** instead of timestamps for better uniqueness
3. 🔄 **Implement image optimization** (resize, compress) on upload
4. 🔄 **Add image cropping** for profile photos
5. 🔄 **Create backup strategy** for uploads directory

---

## 📊 Upload Size Limits

### Current Validations
- **Profile Photos:** 2MB max (`max:2048`)
- **Treatment Options:** 2MB max
- **Settings Images:** 2MB max
- **Accepted Types:** jpeg, png, jpg, gif, webp

### Server Configuration
Check `php.ini` for:
```ini
upload_max_filesize = 2M
post_max_size = 8M
```

---

## 🔍 Quick Reference

### Check if Storage Link Exists
```bash
php artisan storage:link
```

### View All Images in Database
```sql
-- User profile photos
SELECT id, name, profile_photo_path FROM users WHERE profile_photo_path IS NOT NULL;

-- Doctors
SELECT id, name, image FROM doctors WHERE image IS NOT NULL;

-- Services
SELECT id, name, image, icon FROM services WHERE image IS NOT NULL;

-- Gallery
SELECT id, title, image FROM gallery;

-- Treatment Options
SELECT id, name, image FROM treatment_options WHERE image IS NOT NULL;
```

### Blade Template Usage

**Laravel Storage:**
```blade
<img src="{{ asset('storage/' . $user->profile_photo_path) }}" />
<!-- OR -->
<img src="{{ $user->profile_photo_url }}" />
```

**Public Uploads:**
```blade
<img src="{{ asset($doctor->image) }}" />
<img src="{{ asset($service->image) }}" />
<img src="{{ asset($gallery->image) }}" />
```

---

## 🚨 Common Issues & Solutions

### Issue: Images not showing after upload
**Solution:** Run `php artisan storage:link`

### Issue: Upload fails with permission error
**Solution:** 
```bash
chmod -R 755 storage/
chmod -R 755 public/uploads/
```

### Issue: Image paths broken after migration
**Solution:** Check APP_URL in .env file

---

## 📅 Last Updated
**Date:** October 19, 2026  
**Laravel Version:** 11.57.0  
**PHP Version:** 8.4.14

---

## 📞 Contact
For questions about image storage implementation, contact the development team.
