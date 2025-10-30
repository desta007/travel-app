# TravelApp - Travel Booking Platform

TravelApp adalah aplikasi web yang menggabungkan fitur dari Klook dan Japan Guide, memungkinkan pengguna untuk menemukan destinasi wisata, memesan aktivitas, dan mencari hotel dengan tampilan yang modern dan responsive.

## 🚀 Fitur Utama

### Destinasi Wisata
- **Pencarian Destinasi**: Temukan destinasi wisata berdasarkan negara, kategori, dan kata kunci
- **Detail Destinasi**: Informasi lengkap tentang destinasi termasuk rating, review, dan aktivitas tersedia
- **Galeri Foto**: Koleksi foto destinasi untuk memberikan gambaran visual
- **Informasi Praktis**: Detail tentang bahasa, mata uang, zona waktu, dan waktu terbaik untuk berkunjung

### Aktivitas & Pengalaman
- **Beragam Kategori**: Adventure, Culture, Food Tours, Nature, dan lainnya
- **Sistem Booking**: Proses pemesanan yang mudah dengan konfirmasi instan
- **Harga Fleksibel**: Sistem diskon dan harga yang kompetitif
- **Detail Lengkap**: Informasi tentang durasi, tingkat kesulitan, dan persyaratan booking

### Akomodasi
- **Pencarian Hotel**: Filter berdasarkan rating bintang, harga, dan fasilitas
- **Detail Hotel**: Informasi lengkap tentang fasilitas, lokasi, dan kebijakan
- **Sistem Rating**: Rating dan review dari pengguna yang sudah menginap
- **Booking Terintegrasi**: Sistem pemesanan yang terintegrasi dengan aktivitas

### Sistem Review & Rating
- **Review Terverifikasi**: Hanya pengguna dengan booking yang dikonfirmasi dapat memberikan review
- **Rating Komprehensif**: Sistem rating 1-5 bintang dengan kategori pros/cons
- **Foto Review**: Pengguna dapat mengunggah foto dari pengalaman mereka
- **Filter Review**: Filter berdasarkan rating, tanggal, dan tipe perjalanan

### Manajemen Booking
- **Dashboard Booking**: Kelola semua booking dalam satu tempat
- **Status Real-time**: Pantau status booking dan pembayaran secara real-time
- **Sistem Pembayaran**: Simulasi proses pembayaran yang aman
- **Pembatalan Fleksibel**: Kebijakan pembatalan yang jelas dan mudah

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 10**: Framework PHP modern dengan fitur lengkap
- **MySQL**: Database relasional untuk menyimpan data
- **Eloquent ORM**: Object-Relational Mapping untuk interaksi database
- **Blade Templates**: Template engine untuk rendering view

### Frontend
- **Bootstrap 5**: Framework CSS untuk responsive design
- **Font Awesome**: Icon library untuk UI yang menarik
- **Vanilla JavaScript**: JavaScript murni untuk interaktivitas
- **CSS Custom**: Styling custom dengan CSS variables dan modern features

### Fitur Responsive
- **Mobile-First Design**: Optimized untuk perangkat mobile
- **Breakpoints**: Support untuk tablet dan desktop
- **Touch-Friendly**: Interface yang mudah digunakan di layar sentuh
- **Progressive Enhancement**: Fungsi dasar bekerja di semua browser

## 📁 Struktur Proyek

```
travel-app/
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php      # Controller untuk halaman utama dan pencarian
│   │   ├── BookingController.php  # Controller untuk manajemen booking
│   │   └── ReviewController.php    # Controller untuk sistem review
│   └── Models/
│       ├── Destination.php        # Model untuk destinasi wisata
│       ├── Activity.php           # Model untuk aktivitas
│       ├── Hotel.php             # Model untuk hotel
│       ├── Booking.php           # Model untuk booking
│       ├── Review.php            # Model untuk review
│       └── User.php              # Model untuk user
├── database/
│   ├── migrations/               # File migrasi database
│   └── seeders/
│       └── DatabaseSeeder.php    # Seeder untuk data sample
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php     # Layout utama
│   │   ├── auth/                 # View untuk authentication
│   │   ├── bookings/             # View untuk booking
│   │   ├── reviews/              # View untuk review
│   │   ├── home.blade.php        # Halaman utama
│   │   ├── search.blade.php      # Halaman pencarian
│   │   ├── destination.blade.php # Detail destinasi
│   │   ├── activity.blade.php    # Detail aktivitas
│   │   └── hotel.blade.php       # Detail hotel
│   └── css/
│       └── app.css              # CSS custom
├── public/
│   ├── css/
│   │   └── app.css              # CSS yang dikompilasi
│   └── js/
│       └── app.js               # JavaScript aplikasi
└── routes/
    └── web.php                  # Definisi route web
```

## 🚀 Instalasi & Setup

### Prerequisites
- PHP 8.1 atau lebih tinggi
- Composer
- MySQL 5.7 atau lebih tinggi
- Node.js (opsional, untuk asset compilation)

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone <repository-url>
   cd travel-app
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Setup Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database**
   Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=travel_app
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

5. **Jalankan Migrasi**
   ```bash
   php artisan migrate
   ```

6. **Seed Database**
   ```bash
   php artisan db:seed
   ```

7. **Jalankan Server**
   ```bash
   php artisan serve
   ```

8. **Akses Aplikasi**
   Buka browser dan akses `http://localhost:8000`

## 👤 Akun Demo

Untuk testing, gunakan akun demo berikut:
- **Email**: demo@travelapp.com
- **Password**: password

Atau daftar akun baru melalui halaman register.

## 🎨 Design System

### Color Palette
- **Primary**: #667eea (Blue gradient)
- **Secondary**: #764ba2 (Purple gradient)
- **Success**: #28a745 (Green)
- **Warning**: #ffc107 (Yellow)
- **Danger**: #dc3545 (Red)
- **Info**: #17a2b8 (Cyan)

### Typography
- **Font Family**: Figtree, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto
- **Headings**: Font weight 600-700
- **Body**: Font weight 400-500
- **Line Height**: 1.6 untuk readability

### Components
- **Cards**: Rounded corners dengan shadow
- **Buttons**: Gradient background dengan hover effects
- **Forms**: Clean design dengan proper validation states
- **Navigation**: Sticky header dengan backdrop blur

## 📱 Responsive Breakpoints

- **Mobile**: < 768px
- **Tablet**: 768px - 1024px
- **Desktop**: > 1024px

## 🔧 Konfigurasi Tambahan

### Email Configuration
Untuk fitur email (opsional), konfigurasi di `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

### File Upload
Untuk upload gambar review, pastikan direktori `storage/app/public/reviews` dapat ditulis:
```bash
php artisan storage:link
chmod -R 755 storage/app/public
```

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` di `.env`
2. Set `APP_DEBUG=false`
3. Optimize aplikasi:
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

## 🤝 Kontribusi

1. Fork repository
2. Buat feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📄 Lisensi

Distributed under the MIT License. See `LICENSE` for more information.

## 📞 Support

Jika mengalami masalah atau memiliki pertanyaan:
- Buat issue di repository
- Email: support@travelapp.com
- Documentation: [Link ke dokumentasi]

## 🎯 Roadmap

### Fitur Mendatang
- [ ] Sistem notifikasi real-time
- [ ] Integrasi payment gateway
- [ ] Mobile app (React Native)
- [ ] Multi-language support
- [ ] Advanced search filters
- [ ] Social media integration
- [ ] Loyalty program
- [ ] API untuk third-party integration

---

**TravelApp** - Discover Amazing Destinations 🌍✈️