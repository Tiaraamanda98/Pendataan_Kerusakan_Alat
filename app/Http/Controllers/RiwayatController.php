<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Klien;
use App\Models\Cover;
use Carbon\Carbon;

class RiwayatController extends Controller
{
    public function cetakPdf(Request $request)
    {
        $user = Auth::user();

        // Cek apakah data cover tersedia
        $cover = Cover::latest()->first();
        if (!$cover) {
            return redirect()->back()->with('cover_error', 'Data cover belum diisi oleh user. Silahkan lengkapi terlebih dahulu sebelum mencetak PDF.');
        }

        // Validasi tanggal
        if (!$request->start_date || !$request->end_date) {
            return redirect()->back()->with('tanggal_error', 'Silakan isi rentang tanggal terlebih dahulu lalu klik button cari sebelum mencetak PDF.');
        }

        $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
        $endDate = Carbon::parse($request->end_date)->format('Y-m-d');

        // Ambil data sesuai role dan filter
        $riwayatQuery = Klien::with('user')
            ->whereBetween('tgl_keluhan', [$startDate, $endDate]);

        if ($user->role === 'teknisi' || $user->role === 'user') {
            $riwayatQuery->whereHas('user', function ($query) use ($user) {
                $query->where('nama_instansi', $user->nama_instansi);
            });
        } elseif ($user->role === 'admin' && $request->filled('nama_instansi')) {
            $riwayatQuery->whereHas('user', function ($query) use ($request) {
                $query->where('nama_instansi', $request->nama_instansi);
            });
        }

        $riwayat = $riwayatQuery->get();

        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');

        // Buat PDF
        $pdf = Pdf::loadView('riwayat.pdf', [
            'riwayat' => $riwayat,
            'filter_tanggal_mulai' => $startDate,
            'filter_tanggal_selesai' => $endDate,
            'filter_nama_instansi' => $request->nama_instansi,
            'cover' => $cover
        ])->setPaper('a4', 'portrait');

        return $pdf->download('laporan-maintenance.pdf');
    }
}
