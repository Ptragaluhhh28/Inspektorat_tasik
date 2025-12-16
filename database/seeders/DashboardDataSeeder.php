<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Kontak;
use Illuminate\Support\Str;

class DashboardDataSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create sample news
        $newsData = [
            [
                'judul' => 'Inspektorat Kota Tasikmalaya Gelar Sosialisasi Sistem Pengendalian Internal Pemerintah',
                'slug' => Str::slug('Inspektorat Kota Tasikmalaya Gelar Sosialisasi Sistem Pengendalian Internal Pemerintah'),
                'konten' => '<p>Inspektorat Kota Tasikmalaya menggelar kegiatan sosialisasi Sistem Pengendalian Internal Pemerintah (SPIP) kepada seluruh ASN di lingkungan Pemerintah Kota Tasikmalaya.</p><p>Kegiatan ini bertujuan untuk meningkatkan pemahaman ASN terhadap pentingnya penerapan SPIP dalam menjalankan tugas dan fungsinya.</p>',
                'excerpt' => 'Sosialisasi SPIP untuk ASN Kota Tasikmalaya dalam upaya meningkatkan tata kelola pemerintahan yang baik.',
                'gambar' => 'sample-1.jpg',
                'status' => 1,
                'views' => 245,
                'created_at' => now()->subDays(2),
            ],
            [
                'judul' => 'Evaluasi Implementasi Sakip di OPD Lingkungan Pemkot Tasikmalaya',
                'slug' => Str::slug('Evaluasi Implementasi Sakip di OPD Lingkungan Pemkot Tasikmalaya'),
                'konten' => '<p>Inspektorat Kota Tasikmalaya melakukan evaluasi implementasi Sistem Akuntabilitas Kinerja Instansi Pemerintah (SAKIP) di seluruh OPD lingkungan Pemerintah Kota Tasikmalaya.</p><p>Evaluasi ini dilakukan untuk memastikan implementasi SAKIP berjalan sesuai dengan ketentuan yang berlaku.</p>',
                'excerpt' => 'Evaluasi SAKIP untuk memastikan akuntabilitas kinerja instansi pemerintah.',
                'gambar' => 'sample-2.jpg',
                'status' => 1,
                'views' => 189,
                'created_at' => now()->subDays(5),
            ],
            [
                'judul' => 'Workshop Peningkatan Kapasitas Pengawasan Internal',
                'slug' => Str::slug('Workshop Peningkatan Kapasitas Pengawasan Internal'),
                'konten' => '<p>Inspektorat Kota Tasikmalaya mengadakan workshop peningkatan kapasitas pengawasan internal bagi para auditor internal.</p><p>Workshop ini bertujuan untuk meningkatkan kompetensi dan profesionalisme dalam melaksanakan fungsi pengawasan.</p>',
                'excerpt' => 'Workshop untuk meningkatkan kapasitas auditor internal Inspektorat.',
                'gambar' => 'sample-3.jpg',
                'status' => 1,
                'views' => 156,
                'created_at' => now()->subDays(7),
            ]
        ];

        foreach ($newsData as $news) {
            Berita::create($news);
        }

        // Create sample gallery
        $galleryData = [
            [
                'judul' => 'Kegiatan Sosialisasi SPIP 2024',
                'deskripsi' => 'Dokumentasi kegiatan sosialisasi Sistem Pengendalian Internal Pemerintah tahun 2024',
                'gambar' => 'galeri/spip-2024.jpg',
                'kategori' => 'kegiatan',
                'status' => true,
            ],
            [
                'judul' => 'Workshop Auditor Internal',
                'deskripsi' => 'Dokumentasi workshop peningkatan kapasitas auditor internal',
                'gambar' => 'galeri/workshop-auditor.jpg',
                'kategori' => 'pelatihan',
                'status' => true,
            ],
            [
                'judul' => 'Evaluasi SAKIP 2024',
                'deskripsi' => 'Kegiatan evaluasi implementasi SAKIP di OPD Kota Tasikmalaya',
                'gambar' => 'galeri/evaluasi-sakip.jpg',
                'kategori' => 'evaluasi',
                'status' => true,
            ]
        ];

        foreach ($galleryData as $gallery) {
            Galeri::create($gallery);
        }

        // Create sample contacts
        $contactData = [
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@email.com',
                'telepon' => '081234567890',
                'subjek' => 'Pengaduan Pelayanan Publik',
                'pesan' => 'Saya ingin menyampaikan pengaduan terkait pelayanan publik di salah satu OPD. Mohon untuk dapat ditindaklanjuti.',
                'status' => 0, // 0 = baru/unread
                'created_at' => now()->subHours(2),
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@email.com',
                'telepon' => '082345678901',
                'subjek' => 'Permintaan Informasi SAKIP',
                'pesan' => 'Mohon informasi terkait dokumen SAKIP Kota Tasikmalaya tahun 2024.',
                'status' => 1, // 1 = read
                'created_at' => now()->subHours(5),
            ],
            [
                'nama' => 'Ahmad Firdaus',
                'email' => 'ahmad.firdaus@email.com',
                'telepon' => '083456789012',
                'subjek' => 'Saran Perbaikan Website',
                'pesan' => 'Website inspektorat sudah bagus, namun mungkin bisa ditambahkan fitur pencarian berita.',
                'status' => 1, // 1 = read
                'created_at' => now()->subHours(8),
            ],
            [
                'nama' => 'Maya Sari',
                'email' => 'maya.sari@email.com',
                'telepon' => '084567890123',
                'subjek' => 'Pengaduan Whistleblowing',
                'pesan' => 'Saya ingin melaporkan dugaan pelanggaran yang terjadi di salah satu instansi.',
                'status' => 0, // 0 = baru/unread
                'created_at' => now()->subHours(12),
            ],
            [
                'nama' => 'Rizky Pratama',
                'email' => 'rizky.pratama@email.com',
                'telepon' => '085678901234',
                'subjek' => 'Konsultasi Audit Internal',
                'pesan' => 'Mohon konsultasi terkait pelaksanaan audit internal di instansi kami.',
                'status' => 0, // 0 = baru/unread
                'created_at' => now()->subHours(18),
            ]
        ];

        foreach ($contactData as $contact) {
            Kontak::create($contact);
        }

        $this->command->info('Dashboard data seeded successfully!');
    }
}
