<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\Desa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin_dpmd') {
            // Inbox: All documents sent from villages to any DPMD admin
            $inbox = Dokumen::with('sender.desa')
                ->where(function ($q) use ($user) {
                    $q->whereHas('receiverUser', function ($inner) {
                        $inner->where('role', 'admin_dpmd');
                    })->orWhere('receiver_user_id', $user->id);
                })
                ->where('sender_id', '!=', $user->id)
                ->latest()->get();

            // Outbox: Documents sent by THE CURRENT DPMD user to villages
            $outbox = Dokumen::with('receiverDesa')->where('sender_id', $user->id)->latest()->get();

        } else {
            $desa = Desa::where('user_id', $user->id)->first();

            if (!$desa) {
                return redirect()->route('dashboard')->with('error', 'Akun Admin Desa Anda belum terhubung dengan data desa apapun. Silakan hubungi Admin DPMD.');
            }

            // Inbox: Documents sent to this village
            $inbox = Dokumen::with('sender.desa')->where('receiver_desa_id', $desa->id)->latest()->get();
            // Outbox: Documents sent by this village admin to DPMD
            $outbox = Dokumen::with('receiverUser')->where('sender_id', $user->id)->latest()->get();
        }


        return view('dashboard.dokumen.index', compact('inbox', 'outbox'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->role === 'admin_dpmd') {
            $desas = Desa::orderBy('nama_desa')->get();
            return view('dashboard.dokumen.create', compact('desas'));
        } else {
            // For village admins, they can only send to DPMD admin(s)
            $dpmdAdmins = User::where('role', 'admin_dpmd')->get();
            return view('dashboard.dokumen.create', compact('dpmdAdmins'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|file|max:10240', // 10MB
            'keterangan' => 'nullable|string',
            'receiver_id' => 'required', // This can be desa_id (if DPMD sends) or user_id (if Desa sends)
        ]);

        $user = Auth::user();
        $file = $request->file('file');
        $filePath = $file->store('kotak-berkas', 'public');
        $originalName = $file->getClientOriginalName();

        if ($user->role === 'admin_dpmd' && $request->receiver_id === 'all') {
            $desas = Desa::all();
            foreach ($desas as $desa) {
                Dokumen::create([
                    'judul' => $request->judul,
                    'file_path' => $filePath,
                    'original_name' => $originalName,
                    'keterangan' => $request->keterangan,
                    'sender_id' => $user->id,
                    'receiver_desa_id' => $desa->id,
                ]);
            }
            return redirect()->route('dashboard.dokumen.index')->with('success', 'Berkas berhasil dikirim ke seluruh desa!');
        }

        $data = [
            'judul' => $request->judul,
            'file_path' => $filePath,
            'original_name' => $originalName,
            'keterangan' => $request->keterangan,
            'sender_id' => $user->id,
        ];


        if ($user->role === 'admin_dpmd') {
            $data['receiver_desa_id'] = $request->receiver_id;
        } else {
            $data['receiver_user_id'] = $request->receiver_id;
        }

        Dokumen::create($data);

        return redirect()->route('dashboard.dokumen.index')->with('success', 'Berkas berhasil dikirim!');
    }

    public function download($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $user = Auth::user();

        // Check permission
        if ($user->role === 'admin_dpmd') {
            // DPMD can download anything sent TO them or BY them
            $isAuthorized = ($dokumen->sender_id === $user->id) ||
                ($dokumen->receiverUser && $dokumen->receiverUser->role === 'admin_dpmd');

            if (!$isAuthorized)
                abort(403);
        } else {
            // Village admin can only download if they are sender or the designated receiver village
            if ($user->id !== $dokumen->sender_id) {
                $desa = Desa::where('user_id', $user->id)->first();
                if (!$desa || $desa->id !== $dokumen->receiver_desa_id) {
                    abort(403);
                }
            }
        }


        // Mark as read if the recipient is downloading
        if ($user->id !== $dokumen->sender_id) {
            $dokumen->update(['is_read' => true]);
        }

        if (!Storage::disk('public')->exists($dokumen->file_path)) {
            return back()->with('warning', 'File tidak ditemukan.');
        }

        $downloadName = $dokumen->original_name ?? ($dokumen->judul . '.' . pathinfo($dokumen->file_path, PATHINFO_EXTENSION));

        return Storage::disk('public')->download($dokumen->file_path, $downloadName);
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        // Only sender can delete their sent document (or admin)
        if (Auth::id() !== $dokumen->sender_id) {
            abort(403);
        }

        if (Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        return redirect()->back()->with('success', 'Berkas berhasil dibatalkan/dihapus.');
    }
}
