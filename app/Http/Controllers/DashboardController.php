<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Klien;
use App\Models\User;
use App\Models\Aktivitas;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tahunSekarang = Carbon::now()->year;

     
        $dataKeluhan = Klien::selectRaw("MONTH(tgl_keluhan) as bulan, COUNT(*) as total")
            ->whereYear('tgl_keluhan', $tahunSekarang)
            ->when($user->role === 'teknisi', function ($query) use ($user) {
                $query->whereHas('user', function ($subQuery) use ($user) {
                    $subQuery->where('nama_instansi', $user->nama_instansi);
                });
            })
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $allMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $jumlahKeluhanPerBulan = array_fill(0, 12, 0);

        foreach ($dataKeluhan as $item) {
            $index = (int) $item->bulan - 1;
            if ($index >= 0 && $index < 12) {
                $jumlahKeluhanPerBulan[$index] = (int) $item->total;
            }
        }

        $bulanTerbanyak = array_keys($jumlahKeluhanPerBulan, max($jumlahKeluhanPerBulan));
        $jumlahKeluhan = max($jumlahKeluhanPerBulan);
        $data = $jumlahKeluhanPerBulan;

      
        if ($user->role === 'user') {
            return view('users.dashboard', compact('allMonths', 'data', 'bulanTerbanyak', 'jumlahKeluhan'));
        }

        
        $pengaduanBaru = Klien::whereDate('created_at', today())
        ->where('status', 'menunggu') 
        ->when($user->role === 'teknisi', function ($query) use ($user) {
            $query->whereHas('user', function ($subQuery) use ($user) {
                $subQuery->where('nama_instansi', $user->nama_instansi);
            });
        })->count();
    

        $pengaduanDiproses = Klien::where('status', 'menunggu')
            ->when($user->role === 'teknisi', function ($query) use ($user) {
                $query->whereHas('user', function ($subQuery) use ($user) {
                    $subQuery->where('nama_instansi', $user->nama_instansi);
                });
            })->count();

        $pengaduanSelesai = Klien::where('status', 'selesai')
            ->when($user->role === 'teknisi', function ($query) use ($user) {
                $query->whereHas('user', function ($subQuery) use ($user) {
                    $subQuery->where('nama_instansi', $user->nama_instansi);
                });
            })->count();

     
        return view('dashboard', compact(
            'pengaduanBaru',
            'pengaduanDiproses',
            'pengaduanSelesai',
            'allMonths',
            'data',
            'bulanTerbanyak',
            'jumlahKeluhan',
           
        ));
    }

    public function pengaduanBaru()
    {
        $user = Auth::user();
    
        $pengaduanBaru = Klien::whereDate('created_at', today())
            ->where('status', 'menunggu') 
            ->when($user->role === 'teknisi', function ($query) use ($user) {
                $query->whereHas('user', fn($q) => $q->where('nama_instansi', $user->nama_instansi));
            })
            ->latest()
            ->get();
    
        return view('pengaduan_baru', compact('pengaduanBaru'));
    }
    
    public function pengaduanDiproses()
    {
        $user = Auth::user();

        $pengaduanDiproses = Klien::where('status', 'menunggu')
            ->when($user->role === 'teknisi', function ($query) use ($user) {
                $query->whereHas('user', fn($q) => $q->where('nama_instansi', $user->nama_instansi));
            })->latest()->get();

        return view('pengaduan_diproses', compact('pengaduanDiproses'));
    }

    public function pengaduanSelesai()
    {
        $user = Auth::user();

        $pengaduanSelesai = Klien::where('status', 'selesai')
            ->when($user->role === 'teknisi', function ($query) use ($user) {
                $query->whereHas('user', fn($q) => $q->where('nama_instansi', $user->nama_instansi));
            })->latest()->get();

        return view('pengaduan_selesai', compact('pengaduanSelesai'));
    }
}
