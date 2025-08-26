# 📦 Sistem Manajemen Inventori Barang

<p align="center">
  <strong>Aplikasi Laravel untuk mengelola inventori barang kantor dengan fitur QR Code Scanner</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-red?style=flat-square&logo=laravel" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue?style=flat-square&logo=php" alt="PHP Version">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-cyan?style=flat-square&logo=tailwindcss" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/License-MIT-green?style=flat-square" alt="License">
</p>

---

## 📋 Deskripsi

Sistem Manajemen Inventori Barang adalah aplikasi web yang dirancang untuk mengelola inventori barang kantor dengan mudah dan efisien. Aplikasi ini dilengkapi dengan fitur QR Code Scanner yang memungkinkan pengguna untuk dengan cepat mencari, menambah, dan mengelola barang menggunakan kode QR.

## ✨ Fitur Utama

### 🎯 **Dashboard Interaktif**
- Ringkasan statistik inventori
- Quick actions untuk fitur utama
- Navigation yang user-friendly

### 📱 **QR Code Scanner**
- Scanner real-time menggunakan kamera perangkat
- Input manual QR code sebagai fallback
- Auto-redirect ke detail barang atau form tambah barang
- Support HTTPS untuk keamanan camera access

### 🏢 **Manajemen Ruangan**
- Tambah, edit, hapus ruangan
- Informasi lantai dan deskripsi
- Lihat daftar barang per ruangan
- Pencegahan hapus ruangan yang masih berisi barang

### 📦 **Manajemen Barang**
- CRUD lengkap untuk barang
- QR code unik untuk setiap barang
- Informasi brand, type, dan deskripsi
- Relasi dengan ruangan
- Pagination dan pencarian

### 🎨 **User Experience**
- Responsive design (mobile, tablet, desktop)
- Modern UI dengan Tailwind CSS
- Progressive Web App (PWA) ready
- Alpine.js untuk interaktivitas

## 🛠️ Tech Stack

### **Backend**
- **Laravel 12.x** - PHP Framework
- **PHP 8.2+** - Server-side language
- **SQLite** - Database (mudah deployment)
- **Eloquent ORM** - Database abstraction

### **Frontend**
- **Tailwind CSS 3.x** - Utility-first CSS framework
- **Alpine.js 3.x** - Lightweight JavaScript framework
- **Vite** - Modern build tool
- **Responsive Design** - Mobile-first approach

### **Additional Tools**
- **Composer** - PHP dependency manager
- **NPM** - Node.js package manager
- **Axios** - HTTP client untuk AJAX
- **QR Code Scanner** - Browser camera API

## 📋 System Requirements

### **Minimum Requirements**
- **PHP:** 8.2 atau lebih tinggi
- **Composer:** Latest version
- **Node.js:** 18.x atau lebih tinggi
- **NPM:** 9.x atau lebih tinggi
- **Web Browser:** Chrome 80+, Firefox 75+, Safari 13+

### **Recommended for Development**
- **Memory:** 2GB RAM minimum
- **Storage:** 1GB free space
- **Camera:** Untuk fitur QR Scanner (opsional)

## 🚀 Instalasi dan Setup

### **1. Clone atau Download Project**
```bash
# Jika menggunakan Git
git clone [repository-url]
cd my-laravel-app

# Atau extract ZIP file ke folder project
```

### **2. Install Dependencies**
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### **3. Environment Setup**
```bash
# Copy environment file
copy .env.example .env

# Generate application key
php artisan key:generate
```

### **4. Database Setup**
```bash
# Jalankan migrations
php artisan migrate

# Seed database dengan data dummy
php artisan db:seed
```

### **5. Build Assets**
```bash
# Development build
npm run dev

# Production build
npm run build
```

### **6. Start Development Server**
```bash
# Standard local server
php artisan serve

# Network accessible server (untuk testing mobile)
php artisan serve --host=0.0.0.0 --port=8000
```

## 🌐 Network Access & HTTPS Setup

### **Local Development**
```bash
# Akses lokal
http://localhost:8000
```

### **Network Access (LAN)**
```bash
# Akses dari perangkat lain di jaringan yang sama
http://[YOUR-IP-ADDRESS]:8000

# Cek IP address Windows
ipconfig

# Contoh
http://192.168.1.100:8000
```

### **HTTPS untuk QR Scanner**

Modern browsers memerlukan HTTPS untuk mengakses kamera. Untuk production atau testing advanced:

#### **Option 1: ngrok (Recommended)**
```bash
# Install ngrok
npm install -g @ngrok/ngrok

# Expose Laravel server
ngrok http 8000

# Gunakan URL HTTPS yang diberikan
```

#### **Option 2: Self-signed Certificate**
```bash
# Generate SSL certificate
openssl genrsa -out server.key 2048
openssl req -new -x509 -key server.key -out server.crt -days 365

# Setup HTTPS proxy dengan nginx atau apache
```

## 📱 Testing di Berbagai Device

### **Desktop Testing**
- Browser developer tools untuk responsive testing
- Test keyboard navigation
- Test semua fitur CRUD

### **Mobile Testing**
1. Pastikan semua device dalam network yang sama
2. Akses menggunakan IP address server
3. Test QR Scanner dengan kamera
4. Test touch interactions

### **QR Code untuk Testing**
- `BR001` - Laptop Dell di Ruang IT
- `BR002` - Mouse Logitech di Ruang Admin  
- `BR003` - Printer Canon di Ruang Keuangan
- `BR999` - Kode tidak ada (akan redirect ke form tambah)

## 📚 Struktur Database

### **Tables**

#### **rooms**
```sql
- id (Primary Key)
- name (String) - Nama ruangan
- floor (String) - Lantai ruangan
- description (Text, Nullable) - Deskripsi ruangan
- created_at, updated_at
```

#### **items**
```sql
- id (Primary Key)
- brand (String) - Merk barang
- qr_code (String, Unique) - Kode QR unik
- type (String) - Tipe/jenis barang
- room_id (Foreign Key) - Relasi ke rooms
- description (Text, Nullable) - Deskripsi barang
- created_at, updated_at
```

### **Relationships**
- `Room` hasMany `Items`
- `Item` belongsTo `Room`

## 🎯 Cara Penggunaan

### **1. Dashboard**
- Akses halaman utama untuk melihat ringkasan sistem
- Navigasi ke fitur-fitur utama

### **2. Manajemen Ruangan**
- **Tambah Ruangan:** Klik "Tambah Ruangan" → Isi form → Save
- **Edit Ruangan:** Klik "Edit" pada ruangan → Update data → Save  
- **Hapus Ruangan:** Klik "Hapus" (hanya jika tidak ada barang)
- **Lihat Detail:** Klik nama ruangan untuk melihat barang di dalamnya

### **3. Manajemen Barang**
- **Tambah Barang:** Klik "Tambah Barang" → Isi form dengan QR code unik → Save
- **Scan QR:** Gunakan fitur scanner atau input manual → Auto redirect
- **Edit Barang:** Klik "Edit" pada barang → Update data → Save
- **Hapus Barang:** Klik "Hapus" pada barang

### **4. QR Code Scanner**
- Klik "Scan QR Code" di menu
- Izinkan akses kamera jika diminta
- Arahkan kamera ke QR code
- Sistem akan otomatis mencari dan redirect

## 🔧 Development & Customization

### **File Structure**
```
app/
├── Models/
│   ├── Item.php           # Model untuk barang
│   └── Room.php           # Model untuk ruangan
├── Http/Controllers/      # Controllers (jika diperlukan)
└── View/Components/       # Blade components

database/
├── migrations/
│   ├── create_rooms_table.php
│   └── create_items_table.php
└── seeders/
    └── DummyDataSeeder.php

resources/
├── views/
│   ├── dashboard.blade.php
│   ├── items/             # Views untuk barang
│   ├── rooms/             # Views untuk ruangan
│   └── qr-scan/           # Views untuk QR scanner
├── css/
│   └── app.css           # Tailwind CSS
└── js/
    └── app.js            # Alpine.js & custom JS

routes/
└── web.php               # All routes defined here
```

### **Customization Tips**
- **Styling:** Edit `resources/css/app.css` dan konfigurasi Tailwind
- **JavaScript:** Tambah logic di `resources/js/app.js`
- **Views:** Customize Blade templates di `resources/views/`
- **Database:** Buat migration baru untuk perubahan schema
- **Validation:** Update validation rules di routes atau buat Form Requests

## 🧪 Testing

### **Run Tests**
```bash
# Run PHPUnit tests
php artisan test

# Run specific test
php artisan test --filter=ProfileTest
```

### **Manual Testing Checklist**
- [ ] CRUD operations untuk Rooms
- [ ] CRUD operations untuk Items  
- [ ] QR Code scanning (camera & manual)
- [ ] Responsive design di berbagai device
- [ ] Validation forms
- [ ] Error handling
- [ ] Navigation dan routing

## 🔧 Troubleshooting

### **Common Issues**

#### **Camera Access Denied**
- **Solusi:** Gunakan HTTPS atau localhost
- **Alternative:** Gunakan input manual QR code

#### **Assets Not Loading**
```bash
# Rebuild assets
npm run build
php artisan config:clear
```

#### **Database Issues**
```bash
# Reset database
php artisan migrate:fresh --seed
```

#### **Permission Errors**
```bash
# Windows - Set proper permissions
icacls storage /grant Everyone:F /t
icacls bootstrap/cache /grant Everyone:F /t
```

#### **Port Already in Use**
```bash
# Gunakan port lain
php artisan serve --port=8080
```

## 📈 Future Enhancements

### **Planned Features**
- [ ] User authentication & authorization
- [ ] Advanced search & filtering
- [ ] Export data (PDF, Excel)
- [ ] Barcode scanner support
- [ ] Audit trail & history
- [ ] Email notifications
- [ ] API endpoints
- [ ] Mobile app (React Native/Flutter)

### **Technical Improvements**
- [ ] Unit & Feature tests coverage
- [ ] API documentation
- [ ] Docker containerization
- [ ] CI/CD pipeline
- [ ] Performance optimization
- [ ] Security enhancements

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

### **Development Setup**
1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📞 Support

Jika mengalami kendala atau butuh bantuan:

1. **Check Documentation:** Baca README ini dengan lengkap
2. **Common Issues:** Lihat section Troubleshooting
3. **Log Files:** Check `storage/logs/laravel.log` untuk error details
4. **Browser Console:** Check untuk JavaScript errors
5. **Network Issues:** Pastikan firewall tidak memblokir port 8000

---

<p align="center">
  <strong>Happy Inventory Managing! 📦✨</strong>
</p>

---

**Dibuat dengan ❤️ menggunakan Laravel & Tailwind CSS**
