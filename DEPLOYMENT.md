# 📋 Panduan Deployment Laravel di Vercel

## 🚀 Langkah-langkah Deployment

### 1. Persiapan Repository
1. Push kode Anda ke GitHub repository
2. Pastikan semua file konfigurasi telah dibuat (sudah ada di repository ini)

### 2. Setup Vercel Account
1. Buat akun di [vercel.com](https://vercel.com)
2. Login menggunakan akun GitHub Anda

### 3. Import Project
1. Di dashboard Vercel, klik "New Project"
2. Import repository GitHub Anda
3. Pilih framework: **Other**
4. Klik "Deploy"

### 4. Environment Variables
Setelah deployment, tambahkan environment variables berikut di Vercel Dashboard:

```bash
# Aplikasi
APP_NAME=PKKB
APP_ENV=production
APP_KEY=base64:GENERATE_YOUR_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app-name.vercel.app

# Database (gunakan service seperti PlanetScale, Railway, dll)
DB_CONNECTION=mysql
DB_HOST=your-database-host
DB_PORT=3306
DB_DATABASE=your-database-name
DB_USERNAME=your-database-username
DB_PASSWORD=your-database-password

# Cache & Session
CACHE_DRIVER=array
SESSION_DRIVER=cookie
LOG_CHANNEL=stderr

# Email (opsional)
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
```

### 5. Generate APP_KEY
Untuk generate APP_KEY, jalankan perintah ini di local:
```bash
php artisan key:generate --show
```
Copy hasilnya dan masukkan ke environment variable `APP_KEY`.

### 6. Setup Database
Rekomendasi database hosting gratis/murah:
- **PlanetScale** (MySQL, gratis tier tersedia)
- **Railway** (PostgreSQL/MySQL, gratis tier tersedia)
- **Supabase** (PostgreSQL, gratis tier tersedia)
- **Neon** (PostgreSQL, gratis tier tersedia)

### 7. Jalankan Migrasi Database
Setelah database setup, jalankan migrasi:
```bash
# Di local dengan database production
php artisan migrate --force
```

Atau gunakan feature Vercel Functions untuk setup database otomatis.

## 🔧 File Konfigurasi yang Sudah Dibuat

1. **`vercel.json`** - Konfigurasi deployment Vercel
2. **`api/index.php`** - Entry point untuk Vercel
3. **`.vercelignore`** - File yang diabaikan saat deployment
4. **`.env.production`** - Template environment production
5. **`build.sh`** - Script build (jika diperlukan)

## 📝 Catatan Penting

### Batasan Vercel untuk Laravel:
- **Serverless Functions**: Setiap request adalah stateless
- **File Upload**: Gunakan external storage (AWS S3, Cloudinary)
- **Caching**: Gunakan Redis atau database untuk persistent cache
- **Sessions**: Gunakan database atau cookie-based sessions
- **Storage**: File lokal akan hilang setelah request selesai

### Optimisasi Performance:
- Cache konfigurasi sudah diaktifkan
- Route caching diaktifkan
- View caching diaktifkan
- Autoloader optimization diaktifkan

## 🐛 Troubleshooting

### Error: "No application encryption key has been specified"
- Pastikan `APP_KEY` sudah diset di environment variables
- Generate key dengan `php artisan key:generate --show`

### Error: Database Connection
- Periksa kredensial database di environment variables
- Pastikan database host bisa diakses dari Vercel

### Static Assets Tidak Muncul
- Periksa routing di `vercel.json`
- Pastikan file ada di folder `public/`

### 500 Internal Server Error
- Cek logs di Vercel Dashboard
- Periksa environment variables
- Pastikan semua dependencies terinstall

## 📞 Support

Jika mengalami masalah, periksa:
1. Vercel Function Logs
2. Laravel Error Logs (jika ada)
3. Database Connection
4. Environment Variables

## 🎉 Selesai!

Setelah semua langkah di atas, aplikasi Laravel Anda seharusnya sudah berjalan di Vercel!
