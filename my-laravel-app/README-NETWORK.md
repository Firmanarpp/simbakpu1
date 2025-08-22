# Sistem Manajemen Barang Kantor

Website untuk mengelola inventori barang kantor dengan fitur QR Code scanner.

## 🚀 Fitur Utama

- **Dashboard** - Statistik dan ringkasan sistem
- **Scan QR Code** - Scanner QR dengan kamera atau input manual
- **Manajemen Ruangan** - CRUD ruangan lengkap
- **Manajemen Barang** - CRUD barang dengan QR code unik
- **Responsive Design** - Mendukung desktop, tablet, dan mobile
- **PWA Ready** - Dapat diinstall sebagai aplikasi

## 📱 Responsivitas

Website ini telah dioptimalkan untuk berbagai ukuran layar:

### 📱 **Mobile (≤ 768px)**
- Navigation yang mudah diakses dengan hamburger menu
- Cards yang stack vertikal
- Font dan button size yang disesuaikan untuk touch
- QR Scanner dioptimalkan untuk mobile camera
- Touch-friendly interface

### 📱 **Tablet (768px - 1024px)**
- Layout 2 kolom untuk cards
- Optimized button groups
- Balanced spacing dan typography

### 💻 **Desktop (≥ 1024px)**
- Full layout dengan multiple columns
- Hover effects dan animations
- Larger QR scanner area

## 🌐 Network Access & HTTPS

### **Akses Local (Localhost)**
```bash
# Jalankan server standard
php artisan serve
# Akses: http://localhost:8000
```

### **Akses Network (LAN)**
```bash
# Jalankan server dengan network access
php artisan serve --host=0.0.0.0 --port=8000
# Akses dari perangkat lain: http://[IP_ADDRESS]:8000
```

### **HTTPS untuk QR Scanner**

**Mengapa HTTPS diperlukan?**
- Modern browsers memerlukan HTTPS untuk akses kamera
- Untuk QR Scanner berfungsi optimal di network

**Setup HTTPS:**

1. **Install OpenSSL** (jika belum ada)
   - Download: https://slproweb.com/products/Win32OpenSSL.html
   - Install dan tambahkan ke PATH

2. **Generate SSL Certificate**
   ```bash
   # Buat folder ssl
   mkdir ssl
   
   # Generate private key
   openssl genrsa -out ssl/server.key 2048
   
   # Generate certificate
   openssl req -new -x509 -key ssl/server.key -out ssl/server.crt -days 365 -subj "/C=ID/ST=Jakarta/L=Jakarta/O=Kantor/OU=IT/CN=localhost"
   ```

3. **Setup Reverse Proxy dengan Nginx/Apache**
   - Configure HTTPS proxy ke Laravel server
   - Atau gunakan tools seperti ngrok untuk testing

### **Alternative: Local Network Access**

Untuk testing QR Scanner tanpa HTTPS:
1. Gunakan `http://localhost:8000` di komputer host
2. Untuk perangkat lain, gunakan input manual QR code
3. Atau setup local HTTPS proxy

## 🔧 Setup Development

### **Requirements**
- PHP 8.1+
- Composer
- MySQL/SQLite
- Node.js (untuk asset compilation)

### **Installation**
```bash
# Clone atau copy project
cd my-laravel-app

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate
php artisan db:seed

# Run server
php artisan serve --host=0.0.0.0
```

## 📲 PWA Features

Website ini mendukung Progressive Web App:

- **Installable** - Dapat diinstall di home screen
- **Offline Capable** - Service worker untuk caching
- **Responsive** - Adaptive untuk semua ukuran layar
- **Fast Loading** - Optimized assets dan caching

## 🎨 Design System

**Color Scheme:**
- Primary Red: `#dc3545`
- Secondary Orange: `#fd7e14`
- Light Orange: `#fff3cd`
- Background: `#f8f9fa`

**Responsive Breakpoints:**
- Mobile: `≤ 768px`
- Tablet: `768px - 1024px`
- Desktop: `≥ 1024px`

## 📱 Testing di Berbagai Device

### **Desktop Testing**
- Browser developer tools
- Resize window untuk test responsivitas
- Test keyboard navigation

### **Mobile Testing**
1. **Same Network:**
   ```
   http://[YOUR_IP]:8000
   ```

2. **Using ngrok (recommended for HTTPS):**
   ```bash
   # Install ngrok
   npm install -g @ngrok/ngrok
   
   # Expose Laravel server
   ngrok http 8000
   
   # Use provided HTTPS URL
   ```

### **Tablet Testing**
- iPad/Android tablet via network URL
- Test portrait/landscape orientation
- Verify touch interactions

## 🔍 QR Code Testing

**Test QR Codes:**
- `BR001` - Laptop Dell di Ruang IT
- `BR004` - Proyektor Epson di Meeting A
- `BR999` - Kode tidak ada (form tambah barang)

## 🛠️ Troubleshooting

### **Camera Access Issues**
- Pastikan menggunakan HTTPS atau localhost
- Allow camera permission di browser
- Check browser compatibility

### **Network Access Issues**
- Pastikan firewall tidak block port 8000
- Verify IP address: `ipconfig` (Windows) atau `ifconfig` (Linux/Mac)
- Test connectivity: `ping [IP_ADDRESS]`

### **Responsive Issues**
- Clear browser cache
- Check viewport meta tag
- Test different browsers

## 📞 Support

Jika ada kendala dengan setup network atau HTTPS, pastikan:
1. Firewall Windows mengizinkan port 8000
2. Semua device dalam network yang sama
3. Browser support camera API (Chrome, Firefox, Safari modern)
4. HTTPS certificate accepted di browser

---

**Happy Managing! 📦**
