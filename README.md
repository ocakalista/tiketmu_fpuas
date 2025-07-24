# TiketMu

**TiketMu** adalah aplikasi pemesanan tiket acara berbasis web. Aplikasi ini mendukung pembelian tiket konser, seminar, teater, dan pameran. Fitur yang tersedia termasuk sistem autentikasi, manajemen event untuk admin, checkout tiket dengan voucher, QR Code e-ticket, serta halaman pengguna untuk melihat event yang akan dan telah dihadiri.

---

## Fitur Utama

-   Autentikasi (Login, Register, Logout)
-   Manajemen event untuk admin
-   Pencarian & filter event
-   Checkout tiket dengan voucher diskon
-   E-ticket dengan QR Code
-   Riwayat event pengguna
-   Statistik & halaman tentang kami
-   UI responsif berbasis Tailwind CSS

---

## Tech Stack

-   Laravel 11 + Laravel Breeze (Auth)
-   Tailwind CSS (Frontend)
-   MySQL (Database)
-   Simple QrCode (QR generation)
-   Vite (Asset bundler)
-   Git (Version control)

---

## Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini secara lokal:

### 1. Clone Repository

````bash
git clone https://github.com/hilaaml/tiketmu.git
cd tiketmu
````

### 2. Install Dependency

````bash
composer install
composer require simplesoftwareio/simple-qrcode         
````

### 3. Clone Database

````bash
cp .env.example .env
````

#### Atur Konfigurasi Database

Buka file .env dan sesuaikan nama database. Pastikan database ```` tiketmu ```` telah dibuat dahulu.

````bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tiketmu
DB_USERNAME=root
DB_PASSWORD=
````

### 5. Generate App Key

````
php artisan key:generate
````

### 6. Jalankan Migration & Seeder

````bash
php artisan migrate --seed
````

### 7. Jalankan Migration & Seeder

````bash
npm install
npm run dev
````

### 8. Jalankan Server

````bash
php artisan serve
````

### 9. Login

Email: 
````
admin@email.com
````
Password:
````
admin
````
