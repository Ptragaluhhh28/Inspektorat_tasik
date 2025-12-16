<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beritas = [
            [
                'judul' => 'Pengumuman Seleksi Pegawai Non-ASN',
                'konten' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'excerpt' => 'Pengumuman resmi mengenai pembukaan seleksi pegawai non-ASN untuk berbagai posisi.',
                'kategori' => 'Pengumuman',
                'author' => 'Admin Kominfo',
                'status' => 1,
                'views' => 150,
                'tanggal_publish' => now()->subDays(2),
                'slug' => 'pengumuman-seleksi-pegawai-non-asn'
            ],
            [
                'judul' => 'Workshop Digital Marketing untuk UMKM',
                'konten' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'excerpt' => 'Kegiatan workshop pelatihan digital marketing untuk pelaku UMKM di Kabupaten Tasikmalaya.',
                'kategori' => 'Kegiatan',
                'author' => 'Admin Kominfo',
                'status' => 1,
                'views' => 89,
                'tanggal_publish' => now()->subDays(5),
                'slug' => 'workshop-digital-marketing-untuk-umkm'
            ],
            [
                'judul' => 'Sosialisasi Aplikasi E-Government',
                'konten' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                'excerpt' => 'Program sosialisasi penggunaan aplikasi e-government kepada masyarakat.',
                'kategori' => 'Sosialisasi',
                'author' => 'Admin Kominfo',
                'status' => 1,
                'views' => 234,
                'tanggal_publish' => now()->subWeek(),
                'slug' => 'sosialisasi-aplikasi-e-government'
            ],
            [
                'judul' => 'Pelatihan Literasi Digital',
                'konten' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'excerpt' => 'Program pelatihan literasi digital untuk meningkatkan kemampuan masyarakat.',
                'kategori' => 'Pelatihan',
                'author' => 'Admin Kominfo',
                'status' => 1,
                'views' => 178,
                'tanggal_publish' => now()->subDays(10),
                'slug' => 'pelatihan-literasi-digital'
            ],
            [
                'judul' => 'Rapat Koordinasi Bulanan',
                'konten' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.',
                'excerpt' => 'Kegiatan rapat koordinasi bulanan dengan seluruh staff Dinas Kominfo.',
                'kategori' => 'Rapat',
                'author' => 'Admin Kominfo',
                'status' => 1,
                'views' => 67,
                'tanggal_publish' => now()->subDays(3),
                'slug' => 'rapat-koordinasi-bulanan'
            ]
        ];

        foreach ($beritas as $berita) {
            Berita::create($berita);
        }
    }
}
