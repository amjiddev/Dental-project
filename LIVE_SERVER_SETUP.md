# Live Server Image Upload Setup

## Problem Fixed
Images were uploading to `public_html/public/uploads` but not being served properly. The solution uses Laravel's storage system with proper symlink configuration.

## What Changed
1. Created `ImageUploadService` to handle all image uploads consistently
2. Images now upload to `storage/app/uploads` instead of `public/uploads`
3. A symlink connects `public/storage/uploads` to `storage/app/uploads`
4. Updated all admin controllers to use the new service

## Files Modified
- `config/filesystems.php` - Added 'uploads' disk and symlink
- `app/Services/ImageUploadService.php` - New service for image handling
- All controllers in `app/Http/Controllers/Admin/` - Now use ImageUploadService

## Live Server Setup Instructions

### Step 1: Upload Code Changes
Push all changes to your live server and run:
```bash
cd /path/to/your/site
composer install
php artisan config:cache
```

### Step 2: Create Storage Link (CRITICAL)
Run this command on your live server:
```bash
php artisan storage:link
```

This creates a symlink from `public/storage` to `storage/app/public`, and also links `public/storage/uploads` to `storage/app/uploads`.

**If you get "Link already exists" error:**
```bash
rm public/storage
php artisan storage:link
```

### Step 3: Check Permissions
Make sure storage directory has proper permissions:
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### Step 4: Manual Symlink (If artisan command fails)
If the artisan command doesn't work, create the symlink manually via SSH:
```bash
cd /path/to/your/site/public
ln -s ../storage/app/uploads uploads
```

### Step 5: Migrate Old Images (Optional)
If you have existing images in `public/uploads`, move them to `storage/app/uploads`:
```bash
# SSH into your server
cp -r /path/to/your/site/public/uploads/* /path/to/your/site/storage/app/uploads/
```

## How It Works
1. User uploads an image in admin panel
2. Image is stored in: `storage/app/uploads/{folder}/{filename}`
3. Database saves: `storage/uploads/{folder}/{filename}`
4. When displaying, Laravel uses the symlink to serve from: `public/storage/uploads/{folder}/{filename}`
5. This path works on both local and live servers

## Image URL Examples
- Local: `http://localhost/storage/uploads/doctors/1234567890_doctor.jpg`
- Live: `https://yourdomain.com/storage/uploads/doctors/1234567890_doctor.jpg`

## Troubleshooting

### Images Still Not Showing?
1. Check if symlink exists:
   ```bash
   ls -la public/storage
   ```
   Should show: `storage -> ../storage/app/public`

2. Check file permissions:
   ```bash
   ls -la storage/app/uploads/
   ```
   Should be readable by web server user

3. Clear cache:
   ```bash
   php artisan config:cache
   php artisan view:clear
   ```

### Storage Folder Not Writable?
Make sure your web server user (usually `www-data` or `nobody`) owns the storage folder:
```bash
sudo chown -R www-data:www-data /path/to/your/site/storage
```

## Database Migration
If you have existing images, you may need to update their paths in the database:

Old format: `uploads/doctors/1234567890_doctor.jpg`
New format: `storage/uploads/doctors/1234567890_doctor.jpg`

You can use this SQL:
```sql
UPDATE doctors SET image = CONCAT('storage/', image) WHERE image LIKE 'uploads/%';
UPDATE services SET image = CONCAT('storage/', image) WHERE image LIKE 'uploads/%';
UPDATE galleries SET image = CONCAT('storage/', image) WHERE image LIKE 'uploads/%';
UPDATE expert_tips SET image = CONCAT('storage/', image) WHERE image LIKE 'uploads/%';
UPDATE treatment_options SET image = CONCAT('storage/', image) WHERE image LIKE 'uploads/%';
UPDATE settings SET value = CONCAT('storage/', value) WHERE key LIKE '%image%' AND value LIKE 'uploads/%';
```

## Local Development
For local development (Laragon), images will still work fine:
1. Run: `php artisan storage:link` (if you haven't already)
2. Upload images as normal
3. Images appear at: `http://localhost/your-project/storage/uploads/...`

## Benefits of This Approach
✓ Works on both local and live servers
✓ Follows Laravel best practices
✓ Centralized file handling
✓ Easy to scale (could switch to S3 later)
✓ Proper permissions and security
✓ No special web server configuration needed
