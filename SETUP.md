# TravelApp - Setup Instructions

## 🚀 Quick Start Guide

### 1. Prerequisites
Pastikan Anda sudah menginstall:
- PHP 8.1 atau lebih tinggi
- Composer
- MySQL 5.7 atau lebih tinggi
- Git

### 2. Setup Database
1. Buat database MySQL baru:
   ```sql
   CREATE DATABASE travel_app;
   ```

2. Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=travel_app
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

### 3. Install & Run
```bash
# Install dependencies
composer install

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed

# Start development server
php artisan serve
```

### 4. Access Application
Buka browser dan akses: `http://localhost:8000`

## 👤 Demo Account
- **Email**: demo@travelapp.com
- **Password**: password

## 📱 Features Overview

### ✅ Completed Features
- [x] Responsive design (Mobile, Tablet, Desktop)
- [x] User authentication (Login/Register)
- [x] Destination browsing and search
- [x] Activity booking system
- [x] Hotel booking system
- [x] Review and rating system
- [x] Booking management
- [x] Payment simulation
- [x] Modern UI with Bootstrap 5
- [x] Sample data seeding

### 🎨 Design Features
- [x] Modern gradient design
- [x] Responsive navigation
- [x] Card-based layout
- [x] Interactive elements
- [x] Smooth animations
- [x] Mobile-first approach

### 🔧 Technical Features
- [x] Laravel 10 framework
- [x] MySQL database
- [x] Eloquent ORM
- [x] Blade templates
- [x] CSRF protection
- [x] Form validation
- [x] Pagination
- [x] Search functionality

## 📁 Project Structure

```
travel-app/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   └── Models/             # Eloquent models
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/           # Database seeders
├── resources/
│   ├── views/             # Blade templates
│   └── css/               # Custom CSS
├── public/
│   ├── css/               # Compiled CSS
│   └── js/                # JavaScript files
└── routes/
    └── web.php            # Web routes
```

## 🎯 Key Pages

1. **Home** (`/`) - Landing page with featured content
2. **Search** (`/search`) - Search destinations, activities, hotels
3. **Destination** (`/destinations/{id}`) - Destination details
4. **Activity** (`/activities/{id}`) - Activity details and booking
5. **Hotel** (`/hotels/{id}`) - Hotel details and booking
6. **Login** (`/login`) - User authentication
7. **Register** (`/register`) - User registration
8. **Bookings** (`/bookings`) - User booking management
9. **Reviews** (`/reviews`) - Review system

## 🔧 Customization

### Adding New Destinations
1. Use the database seeder or create manually
2. Add images to `public/images/destinations/`
3. Update the seeder with new data

### Styling Changes
1. Edit `public/css/app.css` for global styles
2. Use CSS variables for consistent theming
3. Bootstrap 5 classes for responsive design

### Adding New Features
1. Create new models in `app/Models/`
2. Add migrations in `database/migrations/`
3. Create controllers in `app/Http/Controllers/`
4. Add routes in `routes/web.php`
5. Create views in `resources/views/`

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false`
3. Run optimizations:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

### Server Requirements
- PHP 8.1+
- MySQL 5.7+
- Web server (Apache/Nginx)
- SSL certificate (recommended)

## 🐛 Troubleshooting

### Common Issues

1. **Route not defined error**
   - Run `php artisan route:clear`
   - Check if routes are properly defined

2. **Database connection error**
   - Verify database credentials in `.env`
   - Ensure MySQL service is running

3. **Permission errors**
   - Set proper permissions on `storage/` and `bootstrap/cache/`
   - Run `php artisan storage:link`

4. **CSS/JS not loading**
   - Clear browser cache
   - Check file paths in views

## 📞 Support

For issues or questions:
1. Check the README.md file
2. Review Laravel documentation
3. Check error logs in `storage/logs/`

## 🎉 Enjoy Your TravelApp!

The application is now ready to use. Explore the features, test the booking system, and customize it according to your needs.

**Happy Traveling! 🌍✈️**
