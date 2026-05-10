<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Regulasi;
use App\Models\Desa;
use App\Models\Potensi;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        
        if (!$query) {
            return view('public.search-results', [
                'query' => $query,
                'results' => collect(),
                'total' => 0
            ]);
        }

        // Search in Beritas
        $beritas = Berita::where('judul', 'like', "%{$query}%")
            ->orWhere('konten', 'like', "%{$query}%")
            ->get()
            ->map(function($item) {
                $item->search_type = 'Berita & Kegiatan';
                $item->search_url = route('public.berita.detail', $item->slug);
                $item->search_title = $item->judul;
                $item->search_desc = strip_tags(substr($item->konten, 0, 150)) . '...';
                return $item;
            });

        // Search in Regulasis
        $regulasis = Regulasi::where('judul', 'like', "%{$query}%")
            ->orWhere('nomor', 'like', "%{$query}%")
            ->orWhere('deskripsi', 'like', "%{$query}%")
            ->get()
            ->map(function($item) {
                $item->search_type = 'Regulasi & Dokumen';
                $item->search_url = route('public.bank-data'); // Link to bank data with highlight?
                $item->search_title = $item->judul . ($item->nomor ? ' No. ' . $item->nomor : '');
                $item->search_desc = $item->deskripsi;
                return $item;
            });

        // Search in Desas
        $desas = Desa::where('nama_desa', 'like', "%{$query}%")
            ->orWhere('kecamatan', 'like', "%{$query}%")
            ->orWhere('deskripsi', 'like', "%{$query}%")
            ->get()
            ->map(function($item) {
                $item->search_type = 'Profil Desa';
                $item->search_url = route('public.desa.profil', $item->id);
                $item->search_title = 'Desa ' . $item->nama_desa;
                $item->search_desc = strip_tags(substr($item->deskripsi, 0, 150)) . '...';
                return $item;
            });

        // Search in Potensis
        $potensis = Potensi::where('nama_potensi', 'like', "%{$query}%")
            ->orWhere('deskripsi', 'like', "%{$query}%")
            ->get()
            ->map(function($item) {
                $item->search_type = 'Potensi & Wisata';
                $item->search_url = route('public.potensi-wisata.detail', $item->id);
                $item->search_title = $item->nama_potensi;
                $item->search_desc = strip_tags(substr($item->deskripsi, 0, 150)) . '...';
                return $item;
            });

        $results = collect()
            ->merge($beritas)
            ->merge($regulasis)
            ->merge($desas)
            ->merge($potensis);

        return view('public.search-results', [
            'query' => $query,
            'results' => $results,
            'total' => $results->count()
        ]);
    }
}
