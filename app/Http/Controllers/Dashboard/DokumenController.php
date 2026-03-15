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

        if ($user->role === 'admin_dpmd' || $user->role === 'admin_kecamatan') {
            // Inbox: All documents sent from villages to this admin (or to DPMD in general if they are DPMD)
            $inboxQuery = Dokumen::with('sender.desa')
                ->where('sender_id', '!=', $user->id);

            if ($user->role === 'admin_dpmd') {
                $inboxQuery->where(function ($q) use ($user) {
                    $q->whereHas('receiverUser', function ($inner) {
                        $inner->where('role', 'admin_dpmd');
                    })->orWhere('receiver_user_id', $user->id);
                });
            } else {
                $inboxQuery->where('receiver_user_id', $user->id);
            }
            $inbox = $inboxQuery->latest()->get();

            // Outbox: Documents sent by THE CURRENT user to villages/others
            $outbox = Dokumen::with('receiverDesa', 'receiverUser')->where('sender_id', $user->id)->latest()->get();

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
            $kecamatans = Desa::distinct()->pluck('kecamatan')->sort()->values();
            $kecamatanAdmins = User::where('role', 'admin_kecamatan')->get();
            $dpmdAdmins = collect(); // DPMD sends to villages or kecamatan
            return view('dashboard.dokumen.create', compact('desas', 'dpmdAdmins', 'kecamatanAdmins', 'kecamatans'));
        } elseif ($user->role === 'admin_kecamatan') {
            $desas = Desa::where('kecamatan', $user->kecamatan)->orderBy('nama_desa')->get();
            $dpmdAdmins = User::where('role', 'admin_dpmd')->get();
            return view('dashboard.dokumen.create', compact('desas', 'dpmdAdmins'));
        } else {
            // For village admins
            $dpmdAdmins = User::where('role', 'admin_dpmd')->get();
            $kecamatanAdmins = User::where('role', 'admin_kecamatan')
                ->where('kecamatan', $user->kecamatan)
                ->get();
            return view('dashboard.dokumen.create', compact('dpmdAdmins', 'kecamatanAdmins'));
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

        if ($user->role === 'admin_dpmd' || $user->role === 'admin_kecamatan') {
            if ($request->receiver_id === 'all') {
                if ($user->role === 'admin_kecamatan') {
                    $desas = Desa::where('kecamatan', $user->kecamatan)->get();
                } else {
                    $desas = Desa::all();
                }
                
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
                return redirect()->route('dashboard.dokumen.index')->with('success', 'Berkas berhasil dikirim ke seluruh desa target!');
            }
        }

        $data = [
            'judul' => $request->judul,
            'file_path' => $filePath,
            'original_name' => $originalName,
            'keterangan' => $request->keterangan,
            'sender_id' => $user->id,
        ];


        if ($user->role === 'admin_dpmd' || $user->role === 'admin_kecamatan') {
            // Admin sending to a specific desa (or user)
            // A quick check if receiver_id is a User ID or Desa ID based on the create view context
            // But usually DPMD sends to Desa ID, and Admin Kecamatan sends to Desa ID OR DPMD User ID.
            if (\App\Models\User::find($request->receiver_id)) {
                $data['receiver_user_id'] = $request->receiver_id;
            } else {
                $data['receiver_desa_id'] = $request->receiver_id;
            }
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

        // Check permission: Strictly recipient only for download
        if ($user->id === $dokumen->sender_id) {
            // Sender can't download (as per user request: "dia tidak bisah unduh kecuali hapus")
            abort(403, 'Pengirim tidak diizinkan mengunduh berkas yang sudah terkirim.');
        }

        if ($user->role === 'admin_dpmd') {
            // DPMD can download if they are the receiver
            $isAuthorized = ($dokumen->receiverUser && $dokumen->receiverUser->role === 'admin_dpmd');
            if (!$isAuthorized)
                abort(403);
        } elseif ($user->role === 'admin_kecamatan') {
            // Admin Kecamatan can download if they are the receiver
            if ($dokumen->receiver_user_id !== $user->id) {
                abort(403);
            }
        } else {
            // Village admin can only download if they are the designated receiver village
            $desa = Desa::where('user_id', $user->id)->first();
            if (!$desa || $desa->id !== $dokumen->receiver_desa_id) {
                abort(403);
            }
        }


        // Mark as read if the recipient is downloading
        if ($user->id !== $dokumen->sender_id) {
            $dokumen->update(['is_read' => true]);
        }

        $fullPath = storage_path('app/public/' . $dokumen->file_path);
        if (!file_exists($fullPath)) {
            return back()->with('warning', 'File tidak ditemukan.');
        }

        $downloadName = $dokumen->original_name ?? ($dokumen->judul . '.' . pathinfo($dokumen->file_path, PATHINFO_EXTENSION));

        return response()->download($fullPath, $downloadName);
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        // Only sender can delete their sent document (or admin dpmd)
        if (Auth::user()->role !== 'admin_dpmd' && Auth::id() !== $dokumen->sender_id) {
            abort(403);
        }

        if (Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        return redirect()->route('dashboard.dokumen.index')->with('success', 'Berkas berhasil dibatalkan/dihapus.');
    }
}
