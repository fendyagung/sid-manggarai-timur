<?php
use App\Models\User;
use App\Models\Berita;

$user = User::where('email', 'ngampangmas@desa.id')->first();
if ($user) {
    Berita::create([
        'judul' => 'Pelatihan Kader Posyandu Desa Ngampang Mas',
        'slug' => 'pelatihan-kader-posyandu-desa-ngampang-mas-' . time(),
        'isi' => '<p>Desa Ngampang Mas mengadakan pelatihan rutin bagi kader Posyandu untuk meningkatkan kualitas layanan kesehatan ibu dan anak di tingkat desa.</p>',
        'kategori' => 'Berita Desa',
        'is_published' => true,
        'user_id' => $user->id,
    ]);
    echo "Sample news created successfully!\n";
} else {
    echo "User not found.\n";
}
