# Favicon Setup Instructions

## How to Replace the Tooth Favicon with Your Custom Image

### Step 1: Upload Your Image
1. Save the tooth image from the screenshot as `favicon.png` (or any PNG format)
2. Place it in: `public/assets/media/logos/favicon.png`

### Step 2: System Will Automatically Use It
The favicon will automatically be applied to:
- ✅ Admin pages (all tabs will show the tooth favicon)
- ✅ Frontend/User pages (all tabs will show the tooth favicon)
- ✅ Loading spinner (the tooth will spin while loading)
- ✅ Apple devices (Apple touch icon)
- ✅ Browser bookmarks

### Supported Formats
- PNG (.png) - Recommended
- ICO (.ico) - For compatibility
- SVG (.svg) - Scalable vector

### Files That Use the Favicon
1. `resources/views/layout/master.blade.php` - Admin layout
2. `resources/views/frontend/layouts/frontend.blade.php` - Frontend layout
3. `app/Core/Theme.php` - Favicon function
4. `public/css/loading-spinner.css` - Loading animation

### File Locations
- Main favicon: `public/assets/media/logos/favicon.png`
- Loading spinner CSS: `public/css/loading-spinner.css`
- Favicon SVG backup: `public/assets/media/logos/favicon.svg`

### Current Setup
The system currently uses an SVG tooth design. To replace it:

1. **Option A - PNG Image (Recommended)**
   - Save your tooth image as PNG
   - Place at: `public/assets/media/logos/favicon.png`
   - Size recommendation: 512x512px or larger

2. **Option B - Convert to ICO**
   - Use online converter: https://convertio.co/png-ico/
   - Place at: `public/assets/media/logos/favicon.ico`

3. **Option C - Keep SVG**
   - Already set up at: `public/assets/media/logos/favicon.svg`

### Testing
After uploading:
1. Clear browser cache (Ctrl+Shift+Delete)
2. Refresh the page (Ctrl+F5)
3. Check browser tabs - you should see the tooth favicon
4. Check loading spinner - the tooth should animate while loading

### Need Help?
If the favicon doesn't appear:
1. Clear browser cache completely
2. Restart your browser
3. Check file permissions on the uploaded image
4. Verify the image is in the correct location
