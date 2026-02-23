# Manji Dental & Aesthetic Centre - Website

A comprehensive dental clinic management system built with Laravel, featuring appointment booking, service management, doctor profiles, and admin dashboard.

## Features

### Frontend
- 🏠 Modern homepage with hero section and statistics
- 📅 Online appointment booking system
- 🦷 Dental services showcase
- 👨‍⚕️ Doctor profiles and team page
- 📱 Fully responsive design
- 🎨 Blue-themed professional design

### Admin Panel
- 📊 Dashboard with analytics
- 📋 Appointment management with status updates
- 🏥 Service management (CRUD operations)
- 👥 Doctor management
- 👤 User management with roles & permissions
- 📧 Email notifications (optional)

## Tech Stack

- **Framework:** Laravel 10.x
- **Frontend:** Bootstrap 5, jQuery, Slick Carousel
- **Database:** MySQL
- **Authentication:** Laravel Breeze
- **Admin Theme:** Metronic (Keen Theme)
- **Icons:** Font Awesome 6

## Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL
- XAMPP/WAMP/LAMP (for local development)

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/YOUR-USERNAME/dental-project.git
cd dental-project
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Database

Edit `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dental_project
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run Migrations & Seeders

```bash
# Create database tables
php artisan migrate

# Seed database with sample data
php artisan db:seed
```

### 6. Build Assets

```bash
# For development
npm run dev

# For production
npm run production
```

### 7. Create Storage Link

```bash
php artisan storage:link
```

### 8. Optimize Application

```bash
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 9. Start Development Server

```bash
php artisan serve
```

Visit: `http://localhost:8000`

## Default Login Credentials

### Admin Account
- **Email:** admin@example.com
- **Password:** password

### User Account
- **Email:** user@example.com
- **Password:** password

**⚠️ Important:** Change these credentials after first login!

## Project Structure

```
dental-project/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Admin panel controllers
│   │   └── Frontend/       # Frontend controllers
│   ├── Models/             # Eloquent models
│   └── Mail/               # Email templates
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/           # Database seeders
├── public/
│   ├── assets/            # Compiled assets
│   └── frontend/          # Frontend assets
├── resources/
│   ├── views/
│   │   ├── admin/         # Admin views
│   │   └── frontend/      # Frontend views
│   └── mix/               # Asset compilation config
└── routes/
    └── web.php            # Application routes
```

## Configuration

### Email Setup (Optional)

To enable email notifications:

1. Update `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="Manji Dental & Aesthetic Centre"
```

2. Uncomment email code in `app/Http/Controllers/Admin/AppointmentController.php`

### Performance Optimization

```bash
# Clear all caches
php artisan optimize:clear

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Build production assets
npm run production
```

## Development

### Watch for Changes

```bash
npm run watch
```

This will automatically recompile assets when you make changes.

### Clear Caches During Development

```bash
php artisan optimize:clear
```

## Deployment

### Production Checklist

- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Run `composer install --optimize-autoloader --no-dev`
- [ ] Run `npm run production`
- [ ] Run `php artisan optimize`
- [ ] Configure proper database credentials
- [ ] Set up SSL certificate
- [ ] Configure email settings
- [ ] Change default passwords
- [ ] Set up regular backups

## Troubleshooting

### CSS/JS Not Loading

```bash
npm run production
php artisan optimize:clear
```

### Permission Errors

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### Database Connection Error

- Check database credentials in `.env`
- Ensure MySQL is running
- Create database manually if needed

## Features in Detail

### Appointment System
- Online booking form
- Service selection
- Doctor preference
- Date & time selection
- Status management (Pending, Confirmed, Cancelled, Completed)
- Email notifications (optional)

### Service Management
- Add/Edit/Delete services
- Service categories
- Pricing
- Images
- Active/Inactive status

### Doctor Management
- Doctor profiles
- Specializations
- Qualifications
- Images
- Active/Inactive status

### User Management
- Role-based access control
- Permissions system
- User CRUD operations

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## License

This project is proprietary software. All rights reserved.

## Support

For support, email: info@manjidental.com

## Credits

- **Framework:** Laravel
- **Admin Theme:** Metronic (Keen Theme)
- **Icons:** Font Awesome
- **Fonts:** Google Fonts (Inter, Playfair Display)

---

**Developed for Manji Dental & Aesthetic Centre** Project

## Installation

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Setup
Configure your database in `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Uni_project
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run Migrations & Seeders
```bash
php artisan migrate:fresh --seed
```

### 5. Create Storage Link
```bash
php artisan storage:link
```

### 6. Start Development Server
```bash
php artisan serve
```

Visit: `http://localhost:8000`

## Login Credentials

**Admin:**
```
Email: demo@demo.com
Password: demo
```

After login, you will be redirected to `/dashboard`

## Features
- Admin Dashboard
- User Management
- Role & Permission Management
- Responsive Design

---

**Version:** 1.0.0  
**Framework:** Laravel 9.x
