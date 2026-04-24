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
            'nama_kadis' => 'GASPAR NANGGAR, S.ST.',
            'sambutan_judul' => 'MEMBANGUN DESA MEMBANGUN INDONESIA. DESA MAJU RAKYAT SEJAHTERA.',
            'sambutan_teks' => "Selamat datang di Sistem Informasi Pelaporan Desa. Kami berkomitmen untuk terus mendorong transparansi dan inovasi di setiap desa di Kabupaten Manggarai Timur.\n\nBranding Dinas PMD: Desa Melayani dengan \"HEPI\" (HUMANIS, EDUKATIF, PROFESIONAL DAN INOVATIF). Melalui platform ini, kami mengintegrasikan tata kelola yang akuntabel demi menciptakan pemerintahan desa yang mandiri dan berdaya saing.",
            'visi' => 'Manggarai Timur Maju, Sejahtera, Berbudaya dan Berkelanjutan (MAMA SEBER)',
            'misi' => "Mewujudkan Sumber Daya Manusia Manggarai Timur yang maju dan berkualitas serta adaptif terhadap perkembangan ilmu pengetahuan dan teknologi.\nPenguatan ekonomi kerakyatan yang berbasis potensi daerah dan kearifan lokal untuk pertumbuhan ekonomi inklusif guna mewujudkan pusat pusat pertumbuhan ekonomi baru yang produktif.\nMelanjutkan pembangunan infrastruktur dasar yang berwawasan lingkungan yang merata di berbagai sektor untuk mendorong kesinambungan pembangunan.\nMemperkuat desa membangun menuju desa sebagai basis penghidupan dan kehidupan masyarakat secara berkelanjutan serta menjadikan desa sebagai entitas yang mandiri.\nMewujudkan pembangunan yang dilandasi budaya dan kesetaraan gender serta penguatan peran perempuan dan perlindungan anak.\nMewujudkan tata kelola pemerintahan dan pelayanan publik yang beritegritas, transparan dan reponsif.",
            'nama_sekretaris' => 'Sekretaris Dinas',
            'nama_kabid_pemberdayaan' => 'Bidang (Pemberdayaan dan Lembaga Kemasyarakatan)',
            'nama_kabid_pemerintahan' => 'Bidang (Pemerintahan Desa)',
            'nama_kabid_ekonomi' => 'Bidang (Penataan dan kerja sama)',
            'stat_total_desa' => null,
            'stat_kecamatan' => null,
            'stat_desa_wisata' => null,
            'stat_spot_wisata' => 0,
            'stat_wisatawan' => '17.474',
        ]);
    }
}
