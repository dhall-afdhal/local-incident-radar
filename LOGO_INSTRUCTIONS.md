# Instruksi Logo

## Menambahkan Logo ke Project

Untuk menambahkan logo DHA Production ke project, ikuti langkah berikut:

### 1. Siapkan File Logo

- Format: PNG dengan transparansi (disarankan)
- Ukuran: Minimal 200x200px (untuk kualitas baik)
- Nama file: `logo.png`
- Lokasi: Simpan di folder `public/logo.png`

### 2. Spesifikasi Logo

Logo akan ditampilkan di:
- **Navbar** (atas kiri) - Height: 40px
- **Footer** (opsional) - Sesuai kebutuhan

### 3. Cara Menambahkan

1. Copy file logo Anda ke folder `public/`
2. Pastikan nama file: `logo.png`
3. Refresh browser - logo akan otomatis muncul

### 4. Alternatif (Jika logo belum tersedia)

Jika logo belum tersedia, sistem akan menampilkan icon default (radar icon) di navbar.

### 5. Customisasi (Opsional)

Jika ingin mengubah ukuran atau style logo, edit file:
- `resources/views/layouts/app.blade.php` (baris navbar-brand)
- `resources/views/welcome.blade.php` (baris navbar-brand)

Contoh:
```html
<img src="{{ asset('logo.png') }}" alt="Logo" style="height: 40px; margin-right: 10px;">
```

### Catatan

- Logo akan otomatis terdeteksi jika file `public/logo.png` ada
- Format PNG dengan transparansi direkomendasikan
- Pastikan logo memiliki kontras yang baik dengan background

---

**DHA Production Engineering**  
© 2020 - 2025 Afdhal & DHA Production

