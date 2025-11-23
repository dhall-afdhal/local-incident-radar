# Informasi Database Seeder

## Data yang Telah Di-Seed

### Users (6 Users)
Semua user memiliki password: `password`

1. **Admin User**
   - Email: admin@localincident.com
   - Password: password

2. **John Doe**
   - Email: john@example.com
   - Password: password

3. **Jane Smith**
   - Email: jane@example.com
   - Password: password

4. **Budi Santoso**
   - Email: budi@example.com
   - Password: password

5. **Siti Nurhaliza**
   - Email: siti@example.com
   - Password: password

6. **Ahmad Fauzi**
   - Email: ahmad@example.com
   - Password: password

### Incidents (18 Laporan)

#### Kategori: Infrastruktur (4 laporan)
- Jalan Raya Berlubang Besar (High, Reviewed)
- Jembatan Rusak di Desa Sukamaju (High, Pending)
- Saluran Air Tersumbat (Medium, Pending)
- Jembatan Penyeberangan Rusak (High, Reviewed)

#### Kategori: Keamanan (3 laporan)
- Aksi Perampokan di Pasar Tradisional (High, Reviewed)
- Vandalisme di Taman Kota (Medium, Resolved)
- Penerangan Jalan Kurang (Medium, Pending)

#### Kategori: Kesehatan (3 laporan)
- Wabah DBD di Kelurahan Merdeka (High, Reviewed)
- Sampah Menumpuk di Area Permukiman (Medium, Pending)
- Tempat Sampah Penuh di Area Komersial (Low, Resolved)

#### Kategori: Lingkungan (2 laporan)
- Pencemaran Sungai oleh Limbah Pabrik (High, Reviewed)
- Pohon Tumbang Menghalangi Jalan (Medium, Resolved)

#### Kategori: Lalu Lintas (3 laporan)
- Lampu Lalu Lintas Mati (High, Reviewed)
- Trotoar Diblokir oleh Pedagang Kaki Lima (Medium, Pending)
- Rambu Lalu Lintas Tertutup Tanaman (Low, Pending)

#### Kategori: Umum (3 laporan)
- Fasilitas Taman Bermain Rusak (Medium, Pending)
- Kebisingan dari Pabrik di Malam Hari (Low, Reviewed)
- Fasilitas Umum Tidak Terawat (Low, Resolved)

## Distribusi Status
- **Pending**: 8 laporan
- **Reviewed**: 8 laporan
- **Resolved**: 2 laporan

## Distribusi Urgensi
- **High**: 7 laporan
- **Medium**: 8 laporan
- **Low**: 3 laporan

## Cara Menjalankan Seeder

```bash
# Seed semua data
php artisan db:seed

# Seed hanya users
php artisan db:seed --class=UserSeeder

# Seed hanya incidents
php artisan db:seed --class=IncidentSeeder

# Fresh migration + seed (HATI-HATI: akan menghapus semua data)
php artisan migrate:fresh --seed
```

## Lokasi Koordinat
Semua koordinat berada di area Jakarta dan sekitarnya:
- Latitude: -6.17 hingga -6.25
- Longitude: 106.80 hingga 106.90

## Catatan
- Semua laporan sudah memiliki summary, category, dan urgency_level (sudah diproses AI)
- Beberapa laporan memiliki status berbeda untuk demonstrasi filter
- Data dibuat dengan variasi tanggal untuk menunjukkan timeline

