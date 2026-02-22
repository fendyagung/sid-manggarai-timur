<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DpmdProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\DpmdProfile::updateOrCreate(['id' => 1], [
            'nama_kadis' => 'Nama Kepala Dinas',
            'sambutan_judul' => 'Membangun Desa, Sejahterakan Rakyat',
            'sambutan_teks' => "Selamat datang di Portal SIMPRO DESA Kabupaten Manggarai Timur. Kami berkomitmen untuk terus mendorong transparansi dan inovasi di setiap desa di Kabupaten Manggarai Timur.\n\nMelalui platform ini, kami mengintegrasikan keindahan pariwisata dengan akuntabilitas laporan desa, demi menciptakan pemerintahan desa yang mandiri dan berdaya saing.",
            'visi' => 'Terwujudnya Desa yang Mandiri, Sejahtera, dan Berdaya Saing melalui Tata Kelola Pemerintahan yang Profesional.',
            'misi' => "Pemberdayaan Ekonomi: Meningkatkan kapasitas Badan Usaha Milik Desa (BUMDes) dan potensi ekonomi lokal.\nModernisasi Layanan: Mendorong digitalisasi desa untuk efisiensi pelaporan dan pelayanan masyarakat.\nPengembangan Wisata: Optimasi potensi desa wisata sebagai lokomotif ekonomi baru di Manggarai Timur.",
            'nama_sekretaris' => 'Sekretaris Dinas',
            'nama_kabid_pemberdayaan' => 'Bidang Pemberdayaan',
            'nama_kabid_pemerintahan' => 'Bidang Pemerintahan',
            'nama_kabid_ekonomi' => 'Bidang Ekonomi',
        ]);
    }
}
