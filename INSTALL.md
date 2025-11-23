# Panduan Instalasi Local Incident Radar

## Persyaratan Sistem

- PHP >= 8.2
- Composer
- MySQL >= 5.7 atau MariaDB >= 10.3
- Node.js & NPM (untuk assets, opsional)

## Langkah Instalasi

### 1. Install Dependencies

```bash
composer install
npm install
```

### 2. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=local_incident_radar
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Buat Database

Buat database MySQL dengan nama `local_incident_radar` (atau sesuai konfigurasi di `.env`).

### 4. Jalankan Migrasi

```bash
php artisan migrate
```

### 5. Setup Storage

```bash
php artisan storage:link
```

Ini akan membuat symbolic link dari `public/storage` ke `storage/app/public` sehingga file upload dapat diakses melalui web.

### 6. (Opsional) Konfigurasi AI

Untuk menggunakan fitur AI, tambahkan API key di `.env`:

**OpenAI:**
```env
OPENAI_API_KEY=sk-your-key-here
```

**Atau Google Gemini:**
```env
GEMINI_API_KEY=your-gemini-key-here
```

Jika tidak ada API key, sistem akan menggunakan fallback default (summary = deskripsi, category = "umum", urgency = "low").

### 7. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

## Penggunaan Pertama Kali

1. Buka `http://localhost:8000`
2. Klik "Register" untuk membuat akun baru
3. Login dengan akun yang baru dibuat
4. Klik "Buat Laporan" untuk membuat laporan pertama
5. Isi form dan submit - AI akan otomatis memproses laporan

## Troubleshooting

### Error: Storage link tidak berfungsi
Pastikan folder `storage/app/public` ada dan memiliki permission yang tepat.

### Error: Database connection
Pastikan MySQL service berjalan dan kredensial di `.env` benar.

### Error: AI tidak bekerja
Cek log di `storage/logs/laravel.log`. Jika tidak ada API key, sistem akan menggunakan fallback.

### Error: Foto tidak muncul
Pastikan sudah menjalankan `php artisan storage:link` dan folder `storage/app/public/incidents` ada.

## Struktur Folder Penting

```
storage/
├── app/
│   └── public/
│       └── incidents/     # Foto laporan disimpan di sini
├── framework/
│   ├── cache/
│   ├── sessions/
│   └── views/
└── logs/                   # Log aplikasi
```

## Catatan

- Pastikan folder `storage` dan `bootstrap/cache` memiliki permission write
- Untuk production, set `APP_DEBUG=false` di `.env`
- Pastikan `APP_KEY` sudah di-generate


