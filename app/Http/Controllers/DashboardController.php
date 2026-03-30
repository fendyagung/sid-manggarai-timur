<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\PesanReplyMail;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [];

        if ($user->role === 'admin_dpmd' || $user->role === 'admin_kecamatan') {
            // Base query for desas based on role
            $desaQuery = \App\Models\Desa::query();
            $laporanQuery = \App\Models\Laporan::query();
            
            if ($user->role === 'admin_kecamatan') {
                $desaQuery->where('kecamatan', $user->kecamatan);
                // Pluck IDs to filter laporans
                $desaIds = $desaQuery->pluck('id');
                $laporanQuery->whereIn('desa_id', $desaIds);
            }

            // Data for DPMD / Kecamatan Admin
            $data['total_desa'] = $desaQuery->count();
            $data['total_laporan'] = $laporanQuery->count();
            $data['laporan_pending'] = (clone $laporanQuery)->where('status', 'pending')->count();
            $data['laporan_diterima'] = (clone $laporanQuery)->where('status', 'diterima')->count();
            $data['laporan_ditolak'] = (clone $laporanQuery)->where('status', 'ditolak')->count();

            // Desa yang melapor vs belum melapor (dalam bulan ini)
            $desaSudahLaporCount = (clone $laporanQuery)->whereYear('tanggal_laporan', now()->year)
                ->whereMonth('tanggal_laporan', now()->month)
                ->distinct('desa_id')
                ->count();
            $data['desa_belum_lapor'] = max(0, $data['total_desa'] - $desaSudahLaporCount);
            
            if ($user->role === 'admin_kecamatan') {
                $data['desa_wisata_count'] = (clone $desaQuery)->where('is_desa_wisata', true)->count();
            } else {
                $data['desa_wisata_count'] = \App\Models\Desa::where('is_desa_wisata', true)->count();
            }

            $data['recent_laporans'] = (clone $laporanQuery)->with('desa')->latest()->take(5)->get();
            $data['pending_verification'] = (clone $laporanQuery)->with('desa')->where('status', 'pending')->latest()->take(3)->get();

            $data['total_regulasi'] = \App\Models\Regulasi::count();

            $data['desas'] = (clone $desaQuery)->withCount('laporans')
                ->orderByRaw("CASE WHEN kecamatan = 'Borong' THEN 0 ELSE 1 END")
                ->orderBy('kecamatan', 'asc')
                ->orderByRaw("CASE WHEN jenis = 'kelurahan' THEN 0 ELSE 1 END")
                ->orderBy('nama_desa', 'asc')
                ->get();
        } else {
            // Data for Village Admin: See only their village data
            $desa = Desa::where('user_id', $user->id)->first();

            if ($desa) {
                $data['desa_id'] = $desa->id;
                $data['desa_nama'] = $desa->nama_desa;
                $data['total_laporan'] = $desa->laporans()->count();
                $data['laporan_diterima'] = $desa->laporans()->where('status', 'diterima')->count();
                $data['recent_laporans'] = $desa->laporans()->latest()->take(5)->get();
                $data['potensis'] = $desa->potensis()->latest()->take(2)->get();
                
                // Count unread regulations for this village
                $data['new_regulasi_count'] = \App\Models\Regulasi::where('created_at', '>=', now()->subDays(30))
                    ->whereDoesntHave('downloads', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    })
                    ->count();
            } else {
                $data['desa_id'] = 0;
                $data['desa_nama'] = 'Desa Belum Terdaftar';
                $data['total_laporan'] = 0;
                $data['laporan_diterima'] = 0;
                $data['recent_laporans'] = collect();
                $data['potensis'] = collect();
            }
        }

        // Fetch latest active announcement
        $data['pengumuman'] = \App\Models\Pengumuman::where('is_active', true)
            ->where('show_on_dashboard', true)
            ->latest()
            ->first();

        return view('dashboard', compact('data'));
    }

    public function createReport()
    {
        $user = Auth::user();
        $desa = Desa::where('user_id', $user->id)->first();

        if (!$desa) {
            return redirect()->route('dashboard')->with('error', 'Desa Anda belum terdaftar.');
        }

        return view('public.laporan-create', compact('desa'));
    }

    public function indexReports()
    {
        $user = Auth::user();
        $desa = Desa::where('user_id', $user->id)->first();

        if (!$desa) {
            return redirect()->route('dashboard')->with('error', 'Desa Anda belum terdaftar.');
        }

        $laporans = $desa->laporans()->latest()->paginate(10);

        return view('dashboard.laporan.index', compact('laporans', 'desa'));
    }

    public function storeReport(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:keuangan,penduduk,kejadian,lainnya',
            'keterangan' => 'nullable|string',
            'tanggal_laporan' => 'required|date',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,xls,xlsx|max:10240',
        ]);

        $user = Auth::user();
        $desa = Desa::where('user_id', $user->id)->first();

        $filePath = null;
        $originalName = null;
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filePath = $file->store('laporan-lampiran', 'public');
            $originalName = $file->getClientOriginalName();
        }

        Laporan::create([
            'desa_id' => $desa->id,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'keterangan' => $request->keterangan,
            'file_path' => $filePath,
            'original_name' => $originalName,
            'tanggal_laporan' => $request->tanggal_laporan,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil dikirim dan sedang menunggu verifikasi.');
    }

    public function showLaporan($id)
    {
        $user = Auth::user();
        $laporan = Laporan::with('desa')->findOrFail($id);

        // Security check: If not DPMD, must be the village admin of this report or the kecamatan admin
        if ($user->role !== 'admin_dpmd') {
            if ($user->role === 'admin_kecamatan') {
                if ($laporan->desa->kecamatan !== $user->kecamatan) {
                    abort(403, 'Anda tidak memiliki akses ke laporan di luar kecamatan Anda.');
                }
            } else {
                $desa = Desa::where('user_id', $user->id)->first();
                if (!$desa || $laporan->desa_id !== $desa->id) {
                    abort(403, 'Anda tidak memiliki akses ke laporan ini.');
                }
            }
        }

        return view('public.laporan-detail', compact('laporan'));
    }

    public function showDesa($id)
    {
        $user = Auth::user();

        // Only DPMD and Admin Kecamatan should see the detailed monitoring of a village
        if (!in_array($user->role, ['admin_dpmd', 'admin_kecamatan'])) {
            abort(403, 'Akses terbatas untuk Admin DPMD dan Admin Kecamatan.');
        }

        $desa = Desa::with([
            'laporans' => function ($query) {
                $query->latest();
            }
        ])->findOrFail($id);
        
        if ($user->role === 'admin_kecamatan' && $desa->kecamatan !== $user->kecamatan) {
            abort(403, 'Anda tidak memiliki akses ke desa di luar kecamatan Anda.');
        }

        return view('public.desa-detail', compact('desa'));
    }

    public function approveLaporan($id)
    {
        $user = Auth::user();
        if (!in_array($user->role, ['admin_dpmd', 'admin_kecamatan'])) {
            abort(403);
        }

        $laporan = Laporan::with('desa')->findOrFail($id);
        if ($user->role === 'admin_kecamatan' && $laporan->desa->kecamatan !== $user->kecamatan) {
            abort(403, 'Anda tidak memiliki hak.');
        }
        $laporan->update(['status' => 'diterima']);

        return redirect()->back()->with('success', 'Laporan berhasil disetujui.');
    }

    public function rejectLaporan(Request $request, $id)
    {
        $user = Auth::user();
        if (!in_array($user->role, ['admin_dpmd', 'admin_kecamatan'])) {
            abort(403);
        }

        $laporan = Laporan::with('desa')->findOrFail($id);
        if ($user->role === 'admin_kecamatan' && $laporan->desa->kecamatan !== $user->kecamatan) {
            abort(403, 'Anda tidak memiliki hak.');
        }
        $laporan->update([
            'status' => 'ditolak',
            'catatan_admin' => $request->catatan,
        ]);

        return redirect()->back()->with('warning', 'Laporan telah ditolak.');
    }

    public function toggleWisata($id)
    {
        if (Auth::user()->role !== 'admin_dpmd') {
            abort(403);
        }

        $desa = Desa::findOrFail($id);
        $desa->is_desa_wisata = !$desa->is_desa_wisata;
        $desa->save();

        $status = $desa->is_desa_wisata ? 'diaktifkan sebagai Desa Wisata' : 'dinonaktifkan dari Desa Wisata';
        return redirect()->back()->with('success', "Desa {$desa->nama_desa} berhasil {$status}.");
    }

    public function editDesa()
    {
        $user = Auth::user();
        if ($user->role !== 'admin_desa') {
            abort(403);
        }

        $desa = Desa::where('user_id', $user->id)->first();

        if (!$desa) {
            $desa = Desa::create([
                'user_id' => $user->id,
                'nama_desa' => $user->name,
                'kecamatan' => '-',
            ]);
        }

        return view('dashboard.desa-edit', compact('desa'));
    }

    public function updateDesa(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'admin_desa') {
            abort(403);
        }

        $desa = Desa::where('user_id', $user->id)->firstOrFail();

        $request->validate([
            'nama_desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kepala_desa' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'video_youtube' => 'nullable|url|max:255',
            'jumlah_penduduk' => 'nullable|integer',
            'jumlah_kk' => 'nullable|integer',
            'luas_wilayah' => 'nullable|string|max:255',
            'deskripsi_batas' => 'nullable|string',
            'potensi_ekonomi' => 'nullable|string',
            'gallery_photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'gallery_videos.*' => 'nullable|url|max:255',
        ]);


        $data = $request->only([
            'nama_desa',
            'kecamatan',
            'kepala_desa',
            'deskripsi',
            'video_youtube',
            'jumlah_penduduk',
            'jumlah_kk',
            'luas_wilayah',
            'deskripsi_batas',
            'potensi_ekonomi'
        ]);
        $data['is_desa_wisata'] = $request->has('is_desa_wisata');

        if ($request->hasFile('foto_profil')) {
            $data['foto_profil'] = $request->file('foto_profil')->store('desa-profil', 'public');
        }

        $desa->update($data);

        // Process Gallery Photos
        if ($request->hasFile('gallery_photos')) {
            foreach ($request->file('gallery_photos') as $photo) {
                $path = $photo->store('desa-gallery', 'public');
                $desa->galleries()->create([
                    'type' => 'foto',
                    'url_or_path' => $path,
                ]);
            }
        }

        // Process Gallery Videos
        if ($request->has('gallery_videos')) {
            foreach ($request->gallery_videos as $videoUrl) {
                if ($videoUrl) {
                    $desa->galleries()->create([
                        'type' => 'video',
                        'url_or_path' => $videoUrl,
                    ]);
                }
            }
        }

        return redirect()->route('dashboard.desa.edit')->with('success', 'Profil desa berhasil diperbarui!');
    }

    public function destroyGallery($id)
    {
        $gallery = \App\Models\DesaGallery::findOrFail($id);
        $user = Auth::user();

        // If not DPMD, check if user owns the village this gallery belongs to
        if ($user->role !== 'admin_dpmd') {
            $desa = Desa::where('user_id', $user->id)->first();
            if (!$desa || $gallery->desa_id !== $desa->id) {
                abort(403);
            }
        }

        if ($gallery->type === 'foto') {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($gallery->url_or_path)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($gallery->url_or_path);
            }
        }

        $gallery->delete();

        return redirect()->back()->with('success', 'Item galeri berhasil dihapus.');
    }


    public function editDpmdProfile()
    {
        if (Auth::user()->role !== 'admin_dpmd') {
            abort(403);
        }

        $profile = \App\Models\DpmdProfile::first();
        return view('dashboard.dpmd-edit', compact('profile'));
    }

    public function updateDpmdProfile(Request $request)
    {
        if (Auth::user()->role !== 'admin_dpmd') {
            abort(403);
        }

        $profile = \App\Models\DpmdProfile::first();

        $request->validate([
            'nama_kadis' => 'nullable|string|max:255',
            'foto_kadis' => 'nullable|image|max:5120',
            'foto_struktur' => 'nullable|image|max:5120',
            'logo_website' => 'nullable|image|max:2048',
            'sambutan_judul' => 'nullable|string|max:255',
            'sambutan_teks' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'stat_total_desa' => 'nullable|integer',
            'stat_desa_wisata' => 'nullable|integer',
            'stat_spot_wisata' => 'nullable|integer',
            'stat_wisatawan' => 'nullable|string|max:50',
            'stat_kecamatan' => 'nullable|integer',
            'video_promo_url' => 'nullable|url|max:255',
            'alamat' => 'nullable|string|max:500',
            'telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'gallery_photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'gallery_videos.*' => 'nullable|url|max:255',
        ]);


        $data = $request->except(['gallery_photos', 'gallery_videos', 'nama_sekretaris', 'nama_kabid_pemberdayaan', 'nama_kabid_pemerintahan', 'nama_kabid_ekonomi']);

        if ($request->hasFile('foto_kadis')) {
            $data['foto_kadis'] = $request->file('foto_kadis')->store('dpmd-profile', 'public');
        }

        if ($request->hasFile('foto_struktur')) {
            $data['foto_struktur'] = $request->file('foto_struktur')->store('dpmd-profile', 'public');
        }

        if ($request->hasFile('logo_website')) {
            $data['logo_website'] = $request->file('logo_website')->store('website-branding', 'public');
        }

        $profile->update($data);

        // Process Gallery Photos
        if ($request->hasFile('gallery_photos')) {
            foreach ($request->file('gallery_photos') as $photo) {
                $path = $photo->store('dpmd-gallery', 'public');
                $profile->galleries()->create([
                    'type' => 'foto',
                    'url_or_path' => $path,
                ]);
            }
        }

        // Process Gallery Videos
        if ($request->has('gallery_videos')) {
            foreach ($request->gallery_videos as $videoUrl) {
                if ($videoUrl) {
                    $profile->galleries()->create([
                        'type' => 'video',
                        'url_or_path' => $videoUrl,
                    ]);
                }
            }
        }

        return redirect()->route('dashboard.dpmd.edit-profil')->with('success', 'Profil DPMD berhasil diperbarui!');
    }

    public function destroyDpmdGallery($id)
    {
        if (Auth::user()->role !== 'admin_dpmd') {
            abort(403);
        }

        $gallery = \App\Models\DpmdGallery::findOrFail($id);

        if ($gallery->type === 'foto') {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($gallery->url_or_path)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($gallery->url_or_path);
            }
        }

        $gallery->delete();

        return redirect()->back()->with('success', 'Item galeri berhasil dihapus.');
    }


    public function indexPesans()
    {
        $user = Auth::user();

        if ($user->role === 'admin_dpmd') {
            $pesans = \App\Models\Pesan::latest()->paginate(10);
        } else {
            // Admin Desa only sees messages they sent (associated with their user_id)
            $pesans = \App\Models\Pesan::where('user_id', $user->id)->latest()->paginate(10);
        }

        return view('dashboard.pesans-index', compact('pesans'));
    }


    public function showPesan($id)
    {
        $user = Auth::user();
        $pesan = \App\Models\Pesan::findOrFail($id);

        if ($user->role !== 'admin_dpmd' && $pesan->user_id !== $user->id) {
            abort(403);
        }

        if ($user->role === 'admin_dpmd') {
            $pesan->update(['is_read' => true]);
        } else {
            $pesan->update(['is_read_desa' => true]);
        }

        return view('dashboard.pesans-show', compact('pesan'));
    }


    public function replyPesan(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin_dpmd') {
            abort(403);
        }

        $request->validate([
            'balasan' => 'required|string',
        ]);

        $pesan = \App\Models\Pesan::findOrFail($id);

        // Save reply to internal DB
        $pesan->update([
            'balasan' => $request->balasan,
            'balasan_at' => now(),
            'is_read_desa' => false, // Mark as unread for Admin Desa
        ]);


        // Still send email as double notification (optional but good)
        Mail::to($pesan->email)->send(new PesanReplyMail($pesan, $request->balasan));

        return redirect()->back()->with('success', 'Balasan berhasil dikirim dan tersimpan di sistem!');
    }

    public function destroyPesan($id)
    {
        $user = Auth::user();
        $pesan = \App\Models\Pesan::findOrFail($id);

        // Permission check
        if ($user->role !== 'admin_dpmd' && $pesan->user_id !== $user->id) {
            abort(403);
        }

        $pesan->delete();

        return redirect()->route('dashboard.pesans')->with('success', 'Pesan berhasil dihapus.');
    }

    public function destroyLaporan($id)
    {
        if (Auth::user()->role !== 'admin_dpmd') {
            abort(403);
        }

        $laporan = Laporan::findOrFail($id);

        // Delete associated file if exists
        if ($laporan->file_path && Storage::disk('public')->exists($laporan->file_path)) {
            Storage::disk('public')->delete($laporan->file_path);
        }

        $laporan->delete();

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil dihapus.');
    }

    public function viewRecoveryCodes()
    {
        if (Auth::user()->role !== 'admin_dpmd') {
            abort(403);
        }

        $user = Auth::user();
        return view('dashboard.dpmd.security', compact('user'));
    }

    public function generateRecoveryCodes()
    {
        if (Auth::user()->role !== 'admin_dpmd') {
            abort(403);
        }

        $user = Auth::user();
        $codes = [];
        for ($i = 0; $i < 10; $i++) {
            $codes[] = strtoupper(Str::random(4) . '-' . Str::random(4));
        }

        $user->recovery_codes = $codes;
        $user->save();

        return redirect()->back()->with('success', '10 Kode Pemulihan baru berhasil dibuat. Silakan simpan di tempat aman.');
    }
}
