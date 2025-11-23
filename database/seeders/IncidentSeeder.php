<?php

namespace Database\Seeders;

use App\Models\Incident;
use App\Models\User;
use Illuminate\Database\Seeder;

class IncidentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please run UserSeeder first.');
            return;
        }

        $incidents = [
            // Infrastruktur - High Urgency
            [
                'user_id' => $users->random()->id,
                'title' => 'Jalan Raya Berlubang Besar di Jalan Sudirman',
                'description' => 'Terdapat lubang besar dengan diameter sekitar 1 meter di Jalan Sudirman KM 5. Lubang ini sangat berbahaya bagi pengendara terutama pada malam hari. Sudah ada beberapa kendaraan yang mengalami kerusakan akibat lubang ini. Perlu segera diperbaiki untuk menghindari kecelakaan lebih lanjut.',
                'summary' => 'Lubang besar di Jalan Sudirman KM 5 membahayakan pengendara, perlu perbaikan segera.',
                'category' => 'infrastruktur',
                'urgency_level' => 'high',
                'latitude' => -6.2088,
                'longitude' => 106.8456,
                'image_path' => null,
                'status' => 'reviewed',
                'created_at' => now()->subDays(2),
            ],
            [
                'user_id' => $users->random()->id,
                'title' => 'Jembatan Rusak di Desa Sukamaju',
                'description' => 'Jembatan penghubung Desa Sukamaju dengan desa tetangga mengalami kerusakan struktural. Beberapa balok beton sudah retak dan ada bagian yang sudah ambles. Jembatan ini digunakan oleh ratusan warga setiap hari untuk keperluan ekonomi dan pendidikan. Sangat berbahaya jika tidak segera diperbaiki.',
                'summary' => 'Jembatan di Desa Sukamaju rusak struktural, mengancam keselamatan warga yang melintas setiap hari.',
                'category' => 'infrastruktur',
                'urgency_level' => 'high',
                'latitude' => -6.1751,
                'longitude' => 106.8650,
                'image_path' => null,
                'status' => 'pending',
                'created_at' => now()->subDays(1),
            ],

            // Keamanan - High Urgency
            [
                'user_id' => $users->random()->id,
                'title' => 'Aksi Perampokan di Pasar Tradisional',
                'description' => 'Terjadi aksi perampokan di Pasar Tradisional pada pukul 14:00. Pelaku menggunakan senjata tajam dan mengambil uang dari beberapa pedagang. Korban mengalami luka ringan. Pelaku melarikan diri menggunakan sepeda motor. Perlu penanganan segera dari pihak berwajib.',
                'summary' => 'Perampokan bersenjata di Pasar Tradisional, korban luka ringan, pelaku melarikan diri.',
                'category' => 'keamanan',
                'urgency_level' => 'high',
                'latitude' => -6.2000,
                'longitude' => 106.8167,
                'image_path' => null,
                'status' => 'reviewed',
                'created_at' => now()->subHours(5),
            ],
            [
                'user_id' => $users->random()->id,
                'title' => 'Vandalisme di Taman Kota',
                'description' => 'Taman kota mengalami vandalisme besar-besaran. Banyak fasilitas yang dirusak seperti bangku, lampu taman, dan patung. Coretan grafiti tidak pantas terlihat di dinding-dinding taman. Perlu pembersihan dan perbaikan segera agar taman kembali nyaman untuk warga.',
                'summary' => 'Vandalisme merusak fasilitas taman kota, perlu pembersihan dan perbaikan segera.',
                'category' => 'keamanan',
                'urgency_level' => 'medium',
                'latitude' => -6.2146,
                'longitude' => 106.8451,
                'image_path' => null,
                'status' => 'resolved',
                'created_at' => now()->subDays(5),
            ],

            // Kesehatan - High Urgency
            [
                'user_id' => $users->random()->id,
                'title' => 'Wabah DBD di Kelurahan Merdeka',
                'description' => 'Terdapat peningkatan kasus Demam Berdarah Dengue (DBD) di Kelurahan Merdeka. Sudah ada 15 kasus dalam seminggu terakhir. Banyak genangan air yang menjadi sarang nyamuk. Perlu fogging dan pemberantasan sarang nyamuk segera untuk mencegah penyebaran lebih luas.',
                'summary' => 'Wabah DBD meningkat di Kelurahan Merdeka, 15 kasus dalam seminggu, perlu fogging segera.',
                'category' => 'kesehatan',
                'urgency_level' => 'high',
                'latitude' => -6.2297,
                'longitude' => 106.8000,
                'image_path' => null,
                'status' => 'reviewed',
                'created_at' => now()->subDays(3),
            ],
            [
                'user_id' => $users->random()->id,
                'title' => 'Sampah Menumpuk di Area Permukiman',
                'description' => 'Sampah menumpuk di area permukiman padat penduduk. Sampah sudah tidak diangkut selama 2 minggu dan mulai menimbulkan bau tidak sedap. Banyak lalat dan tikus yang berkeliaran. Kondisi ini sangat tidak sehat dan berpotensi menimbulkan penyakit. Perlu pengangkutan sampah segera.',
                'summary' => 'Sampah menumpuk 2 minggu di permukiman, menimbulkan bau dan berpotensi penyakit.',
                'category' => 'kesehatan',
                'urgency_level' => 'medium',
                'latitude' => -6.2500,
                'longitude' => 106.8500,
                'image_path' => null,
                'status' => 'pending',
                'created_at' => now()->subDays(1),
            ],

            // Lingkungan - Medium Urgency
            [
                'user_id' => $users->random()->id,
                'title' => 'Pencemaran Sungai oleh Limbah Pabrik',
                'description' => 'Sungai di daerah industri tercemar oleh limbah pabrik. Air berubah warna menjadi hitam dan berbau menyengat. Ikan-ikan mati mengapung di permukaan. Warga yang menggunakan air sungai untuk keperluan sehari-hari merasa khawatir. Perlu investigasi dan penanganan dari dinas lingkungan hidup.',
                'summary' => 'Sungai tercemar limbah pabrik, air hitam berbau, ikan mati, mengancam kesehatan warga.',
                'category' => 'lingkungan',
                'urgency_level' => 'high',
                'latitude' => -6.1800,
                'longitude' => 106.9000,
                'image_path' => null,
                'status' => 'reviewed',
                'created_at' => now()->subDays(4),
            ],
            [
                'user_id' => $users->random()->id,
                'title' => 'Pohon Tumbang Menghalangi Jalan',
                'description' => 'Pohon besar tumbang akibat hujan deras dan angin kencang. Pohon menghalangi jalan utama dan mengganggu lalu lintas. Beberapa kendaraan terpaksa memutar. Belum ada yang membersihkan pohon tersebut. Perlu penanganan dari dinas kebersihan atau pertamanan.',
                'summary' => 'Pohon tumbang menghalangi jalan utama, mengganggu lalu lintas, perlu pembersihan.',
                'category' => 'lingkungan',
                'urgency_level' => 'medium',
                'latitude' => -6.1900,
                'longitude' => 106.8200,
                'image_path' => null,
                'status' => 'resolved',
                'created_at' => now()->subDays(6),
            ],

            // Lalu Lintas - Medium Urgency
            [
                'user_id' => $users->random()->id,
                'title' => 'Lampu Lalu Lintas Mati di Perempatan Ramai',
                'description' => 'Lampu lalu lintas di perempatan Jalan Gatot Subroto dan Jalan Thamrin mati total. Perempatan ini sangat ramai terutama pada jam sibuk. Tanpa lampu lalu lintas, kondisi menjadi kacau dan rawan kecelakaan. Sudah terjadi beberapa kali hampir tabrakan. Perlu perbaikan segera.',
                'summary' => 'Lampu lalu lintas mati di perempatan ramai, rawan kecelakaan, perlu perbaikan segera.',
                'category' => 'lalu-lintas',
                'urgency_level' => 'high',
                'latitude' => -6.1944,
                'longitude' => 106.8229,
                'image_path' => null,
                'status' => 'reviewed',
                'created_at' => now()->subHours(12),
            ],
            [
                'user_id' => $users->random()->id,
                'title' => 'Trotoar Diblokir oleh Pedagang Kaki Lima',
                'description' => 'Trotoar di Jalan Pasar Baru diblokir oleh pedagang kaki lima. Pejalan kaki terpaksa berjalan di jalan raya yang berbahaya. Kondisi ini sudah berlangsung lama dan mengganggu aksesibilitas. Perlu penertiban dari satpol PP untuk mengatur pedagang agar tidak menghalangi trotoar.',
                'summary' => 'Trotoar diblokir pedagang kaki lima, pejalan kaki terpaksa di jalan raya, perlu penertiban.',
                'category' => 'lalu-lintas',
                'urgency_level' => 'medium',
                'latitude' => -6.1700,
                'longitude' => 106.8300,
                'image_path' => null,
                'status' => 'pending',
                'created_at' => now()->subDays(2),
            ],

            // Umum - Low Urgency
            [
                'user_id' => $users->random()->id,
                'title' => 'Fasilitas Taman Bermain Rusak',
                'description' => 'Beberapa fasilitas di taman bermain anak-anak mengalami kerusakan. Ayunan putus, perosotan retak, dan beberapa mainan lainnya tidak berfungsi dengan baik. Anak-anak masih tetap bermain di sana yang berpotensi berbahaya. Perlu perbaikan untuk keselamatan anak-anak.',
                'summary' => 'Fasilitas taman bermain rusak, ayunan putus dan perosotan retak, berbahaya untuk anak-anak.',
                'category' => 'umum',
                'urgency_level' => 'medium',
                'latitude' => -6.2100,
                'longitude' => 106.8400,
                'image_path' => null,
                'status' => 'pending',
                'created_at' => now()->subDays(7),
            ],
            [
                'user_id' => $users->random()->id,
                'title' => 'Kebisingan dari Pabrik di Malam Hari',
                'description' => 'Pabrik di kawasan industri mengeluarkan suara bising yang sangat mengganggu terutama pada malam hari. Warga sekitar kesulitan tidur karena suara mesin yang terus beroperasi. Sudah beberapa kali dikeluhkan tetapi belum ada tindakan. Perlu penanganan dari dinas lingkungan untuk mengatur jam operasi pabrik.',
                'summary' => 'Kebisingan pabrik mengganggu warga di malam hari, perlu pengaturan jam operasi.',
                'category' => 'umum',
                'urgency_level' => 'low',
                'latitude' => -6.1750,
                'longitude' => 106.8950,
                'image_path' => null,
                'status' => 'reviewed',
                'created_at' => now()->subDays(10),
            ],
            [
                'user_id' => $users->random()->id,
                'title' => 'Fasilitas Umum Tidak Terawat',
                'description' => 'Fasilitas umum seperti tempat duduk, tempat sampah, dan lampu penerangan di area publik tidak terawat dengan baik. Banyak yang rusak dan tidak berfungsi. Kondisi ini membuat area publik menjadi tidak nyaman untuk digunakan warga. Perlu perawatan rutin dari dinas terkait.',
                'summary' => 'Fasilitas umum tidak terawat, banyak yang rusak, perlu perawatan rutin.',
                'category' => 'umum',
                'urgency_level' => 'low',
                'latitude' => -6.2200,
                'longitude' => 106.8100,
                'image_path' => null,
                'status' => 'resolved',
                'created_at' => now()->subDays(15),
            ],

            // Infrastruktur - Medium Urgency
            [
                'user_id' => $users->random()->id,
                'title' => 'Saluran Air Tersumbat di Perumahan',
                'description' => 'Saluran air di perumahan tersumbat oleh sampah dan lumpur. Saat hujan, air meluap ke jalan dan masuk ke beberapa rumah. Warga sudah mencoba membersihkan sendiri tetapi tidak berhasil. Perlu bantuan dari dinas pekerjaan umum untuk membersihkan saluran secara menyeluruh.',
                'summary' => 'Saluran air tersumbat, air meluap saat hujan, perlu pembersihan menyeluruh.',
                'category' => 'infrastruktur',
                'urgency_level' => 'medium',
                'latitude' => -6.2300,
                'longitude' => 106.8600,
                'image_path' => null,
                'status' => 'pending',
                'created_at' => now()->subDays(3),
            ],
            [
                'user_id' => $users->random()->id,
                'title' => 'Jembatan Penyeberangan Rusak',
                'description' => 'Jembatan penyeberangan untuk pejalan kaki mengalami kerusakan. Beberapa bagian pagar sudah hilang dan lantai ada yang berlubang. Jembatan ini digunakan oleh banyak pejalan kaki termasuk anak sekolah. Sangat berbahaya jika tidak diperbaiki.',
                'summary' => 'Jembatan penyeberangan rusak, pagar hilang dan lantai berlubang, berbahaya untuk pejalan kaki.',
                'category' => 'infrastruktur',
                'urgency_level' => 'high',
                'latitude' => -6.2050,
                'longitude' => 106.8350,
                'image_path' => null,
                'status' => 'reviewed',
                'created_at' => now()->subHours(8),
            ],

            // Keamanan - Medium Urgency
            [
                'user_id' => $users->random()->id,
                'title' => 'Penerangan Jalan Kurang di Area Gelap',
                'description' => 'Area perumahan memiliki penerangan jalan yang sangat kurang. Banyak lampu jalan yang mati atau tidak berfungsi. Kondisi ini membuat area menjadi gelap dan rawan kejahatan terutama pada malam hari. Warga merasa tidak aman berjalan di malam hari.',
                'summary' => 'Penerangan jalan kurang, banyak lampu mati, area gelap rawan kejahatan.',
                'category' => 'keamanan',
                'urgency_level' => 'medium',
                'latitude' => -6.2400,
                'longitude' => 106.8700,
                'image_path' => null,
                'status' => 'pending',
                'created_at' => now()->subDays(4),
            ],

            // Kesehatan - Low Urgency
            [
                'user_id' => $users->random()->id,
                'title' => 'Tempat Sampah Penuh di Area Komersial',
                'description' => 'Tempat sampah di area komersial sudah penuh dan tidak diangkut. Sampah mulai berceceran di sekitar tempat sampah dan menimbulkan bau tidak sedap. Area ini ramai dikunjungi warga sehingga perlu kebersihan yang baik.',
                'summary' => 'Tempat sampah penuh di area komersial, sampah berceceran, perlu pengangkutan.',
                'category' => 'kesehatan',
                'urgency_level' => 'low',
                'latitude' => -6.1950,
                'longitude' => 106.8250,
                'image_path' => null,
                'status' => 'resolved',
                'created_at' => now()->subDays(8),
            ],

            // Lalu Lintas - Low Urgency
            [
                'user_id' => $users->random()->id,
                'title' => 'Rambu Lalu Lintas Tertutup Tanaman',
                'description' => 'Rambu lalu lintas penting tertutup oleh tanaman yang tumbuh liar. Rambu tidak terlihat dengan jelas sehingga membahayakan pengendara. Perlu pemangkasan tanaman agar rambu terlihat jelas.',
                'summary' => 'Rambu lalu lintas tertutup tanaman liar, tidak terlihat jelas, perlu pemangkasan.',
                'category' => 'lalu-lintas',
                'urgency_level' => 'low',
                'latitude' => -6.1850,
                'longitude' => 106.8150,
                'image_path' => null,
                'status' => 'pending',
                'created_at' => now()->subDays(12),
            ],
        ];

        foreach ($incidents as $incident) {
            Incident::create($incident);
        }

        $this->command->info('Created ' . count($incidents) . ' incidents successfully.');
    }
}

