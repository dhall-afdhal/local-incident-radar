<div align="center">

# 🚨 Local Incident Radar

![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)
![License](https://img.shields.io/badge/license-Proprietary-orange.svg)
![Status](https://img.shields.io/badge/status-Demo-yellow.svg)

**Sistem Pelaporan Kejadian Lokal dengan Teknologi AI**

[Features](#-features) • [Installation](#-installation) • [Demo](#-demo) • [Contact](#-contact)

---

</div>

## 📋 Tentang Project

**Local Incident Radar** adalah sistem pelaporan kejadian lokal yang cerdas dengan integrasi teknologi **Artificial Intelligence (AI)** untuk analisis otomatis laporan. Platform ini memungkinkan warga untuk melaporkan berbagai kejadian seperti masalah infrastruktur, keamanan, kesehatan, lingkungan, lalu lintas, dan kejadian umum lainnya.

### 🎯 Fitur Utama

- ✅ **AI-Powered Analysis** - Analisis otomatis dengan OpenAI/Gemini API
- ✅ **GPS Tracking** - Pelaporan dengan koordinat GPS akurat
- ✅ **Upload Foto** - Sertakan bukti visual kejadian
- ✅ **Dashboard Real-time** - Monitor semua laporan dengan filter canggih
- ✅ **Peta Publik Interaktif** - Visualisasi kejadian di peta dengan LeafletJS
- ✅ **Authentication System** - Sistem keamanan dengan Laravel Breeze
- ✅ **Responsive Design** - Fully responsive untuk semua device

### 🤖 Teknologi AI

Sistem menggunakan AI untuk:
- **Generate Summary** - Membuat ringkasan otomatis dari deskripsi laporan
- **Auto Categorization** - Mengkategorikan laporan (infrastruktur, keamanan, kesehatan, dll)
- **Urgency Detection** - Menentukan level urgensi (low, medium, high)

### 🛠️ Tech Stack

- **Backend:** Laravel 11
- **Database:** MySQL
- **Frontend:** Blade Templates, Bootstrap 5
- **Maps:** LeafletJS
- **AI:** OpenAI API / Google Gemini API
- **Icons:** Bootstrap Icons

---

## ⚠️ Status Project

<div align="center">

### 🟡 **DEMO VERSION**

**Ini adalah versi DEMO dari Local Incident Radar.**

Versi ini dibuat untuk demonstrasi fitur-fitur utama dan pengujian sistem. Beberapa fitur mungkin masih dalam tahap pengembangan atau memiliki keterbatasan.

</div>

### 📝 Catatan Penting

- ⚠️ **Versi Demo** - Project ini masih dalam tahap pengembangan
- 🔒 **Data Demo** - Menggunakan data contoh untuk demonstrasi
- 🚧 **Fitur Terbatas** - Beberapa fitur mungkin belum sepenuhnya optimal
- 🔄 **Update Berkala** - Project akan terus dikembangkan

### 💼 Versi Full / Production

Jika Anda tertarik menggunakan **versi full/production** dengan fitur lengkap, custom development, atau integrasi khusus, silakan hubungi kami melalui:

**📧 Email:** [dhaproductionengineering@gmail.com](mailto:dhaproductionengineering@gmail.com)

Kami dapat menyediakan:
- ✅ Versi production-ready
- ✅ Custom features sesuai kebutuhan
- ✅ Integrasi dengan sistem lain
- ✅ Support & maintenance
- ✅ Training & dokumentasi

---

## 🚀 Installation

### Persyaratan

- PHP >= 8.2
- Composer
- MySQL >= 5.7
- Node.js & NPM (opsional)

### Langkah Instalasi

1. **Clone Repository**
```bash
git clone https://github.com/dhall-afdhal/local-incident-radar.git
cd local-incident-radar
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Setup Environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Konfigurasi Database**
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=local_incident_radar
DB_USERNAME=root
DB_PASSWORD=
```

5. **Jalankan Migrasi & Seeder**
```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
```

6. **Jalankan Server**
```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

### Konfigurasi AI (Opsional)

Tambahkan API key di `.env`:
```env
OPENAI_API_KEY=your-openai-key
# atau
GEMINI_API_KEY=your-gemini-key
```

Jika tidak ada API key, sistem akan menggunakan fallback default.

---

## 📸 Screenshots

### Landing Page
<p align="center">
  <img src="https://via.placeholder.com/800x400?text=Landing+Page" width="700">
</p>

### Dashboard
<p align="center">
  <img src="https://via.placeholder.com/800x400?text=Dashboard" width="700">
</p>

### Peta Publik
<p align="center">
  <img src="https://via.placeholder.com/800x400?text=Public+Map" width="700">
</p>


## 📚 Dokumentasi

- [Installation Guide](INSTALL.md)
- [Project Summary](PROJECT_SUMMARY.md)
- [Database Seeder Info](database/seeders/SEEDER_INFO.md)

---

## 🎯 Fitur Detail

### 1. Authentication
- Login & Register
- Password Reset
- Email Verification
- Profile Management

### 2. Incident Reporting
- Form pelaporan lengkap
- Upload foto (max 2MB)
- GPS auto-detect
- Validasi real-time

### 3. AI Processing
- Auto summary generation
- Auto categorization
- Auto urgency detection
- Fallback jika API tidak tersedia

### 4. Dashboard Admin
- Table list laporan
- Filter: kategori, urgensi, status
- Pagination
- Search & sort

### 5. Public Map
- Peta interaktif dengan LeafletJS
- Marker berwarna sesuai urgensi
- Popup informasi
- API endpoint untuk data

---

## 🔐 Default Login (Demo)

Setelah menjalankan seeder, Anda dapat login dengan:

- **Email:** admin@localincident.com
- **Password:** password

Atau gunakan user lain dari seeder.

---

## 📊 Database Structure

### Tables
- `users` - Data pengguna
- `incidents` - Data laporan kejadian
- `sessions` - Session management
- `jobs` - Queue jobs
- `cache` - Cache storage

---

## 🛣️ Roadmap

- [ ] Real-time notifications
- [ ] Email notifications
- [ ] Mobile app (React Native)
- [ ] Advanced analytics
- [ ] Multi-language support
- [ ] Admin panel enhancements
- [ ] API documentation
- [ ] Unit & Feature tests

---

## 🤝 Contributing

Project ini masih dalam tahap pengembangan. Untuk kontribusi atau saran, silakan:

1. Fork repository
2. Create feature branch
3. Commit changes
4. Push to branch
5. Create Pull Request

---

## 📞 Contact & Support

<div align="center">

### 💼 DHA Production Engineering

**📧 Email:** [dhaproductionengineering@gmail.com](mailto:dhaproductionengineering@gmail.com)

**👨‍💻 Developer:** Afdhal

**🏢 Organization:** DHA Production

---

### 💬 Follow & Support

<a href="https://github.com/dhall-afdhal">
  <img src="https://img.shields.io/github/followers/dhall-afdhal?label=Follow&style=social" alt="Follow on GitHub">
</a>

<br><br>

<blockquote>

✨ Jika kamu menyukai proyek ini, jangan lupa untuk memberi ⭐ <b>Star</b> dan <b>Follow</b> <a href="https://github.com/dhall-afdhal">@dhall-afdhal</a> agar tidak ketinggalan update terbaru!

</blockquote>

</div>

---

## 🪪 Lisensi & Hak Cipta

<div align="center">

<h2>🪪 Lisensi & Hak Cipta</h2>

<p>

© <b>2020 - 2025</b> <a href="https://github.com/dhall-afdhal"><b>𝘈𝘧𝘥𝘩𝘢𝘭 & 𝘋𝘏𝘈 𝘗𝘳𝘰𝘥𝘶𝘤𝘵𝘪𝘰𝘯</b></a> — All rights reserved.

</p>

<blockquote>

🧠 <i>Diciptakan dengan semangat belajar, keamanan, dan inovasi oleh Afdhal.</i><br>

💻 <i>Powered by <b>Modern Web Technologies</b> — Laravel 11, MySQL, Bootstrap 5, LeafletJS, AI Integration.</i>

</blockquote>

</div>

---

<div align="center">

**⭐ Jika proyek ini membantu Anda, jangan lupa berikan Star! ⭐**  

Made with ❤️ by <a href="https://github.com/dhall-afdhal">Afdhal</a> | DHA Production

</div>

---

## 📝 Changelog

### Version 1.0.0 (Demo)
- ✅ Initial release
- ✅ Authentication system
- ✅ Incident reporting
- ✅ AI integration
- ✅ Dashboard & map
- ✅ Responsive design

---

## 🙏 Acknowledgments

- Laravel Framework
- Bootstrap
- LeafletJS
- OpenAI / Google Gemini
- Bootstrap Icons

---

<div align="center">

**🚨 Local Incident Radar - Sistem Pelaporan Kejadian Lokal dengan AI**

[⬆ Back to Top](#-local-incident-radar)

</div>
