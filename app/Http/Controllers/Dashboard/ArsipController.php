<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Arsip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    public function index()
    {
        $arsips = Arsip::where('user_id', Auth::id())->latest()->get();
        return view('dashboard.arsip.index', compact('arsips'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240', // Limit to safe formats, Max 10MB
            'keterangan' => 'nullable|string',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('kotak-arsip', 'public');
        $originalName = $file->getClientOriginalName();

        Arsip::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'file_path' => $filePath,
            'original_name' => $originalName,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('dashboard.arsip.index')->with('success', 'Berkas berhasil disimpan ke arsip dinas!');
    }

    public function download($id)
    {
        $arsip = Arsip::where('user_id', Auth::id())->findOrFail($id);
        $fullPath = storage_path('app/public/' . $arsip->file_path);

        if (!file_exists($fullPath)) {
            return back()->with('warning', 'File tidak ditemukan.');
        }

        $downloadName = $arsip->original_name ?? ($arsip->judul . '.' . pathinfo($arsip->file_path, PATHINFO_EXTENSION));

        return response()->download($fullPath, $downloadName);
    }

    public function destroy($id)
    {
        $arsip = Arsip::where('user_id', Auth::id())->findOrFail($id);

        if (Storage::disk('public')->exists($arsip->file_path)) {
            Storage::disk('public')->delete($arsip->file_path);
        }

        $arsip->delete();

        return redirect()->route('dashboard.arsip.index')->with('success', 'Berkas arsip berhasil dihapus.');
    }
}
