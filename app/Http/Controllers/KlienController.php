<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use App\Models\Teknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Mail\KeluhanNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

 
class KlienController extends Controller
{
  
    public function index(Request $request)
{
    $search = $request->input('search');
    
  
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
    }

    $user = auth()->user();
    
    $query = Klien::orderBy('created_at', 'desc');
    
  
    if ($user->role === 'user') {
        
        if ($search) {
            $query->where('tgl_keluhan', 'like', "%{$search}%");
        }

        $query->where('user_id', $user->id);

    } elseif ($user->role === 'teknisi') {
      
        $query->whereHas('user', function ($q) use ($user) {
            $q->whereRaw('LOWER(nama_instansi) = ?', [strtolower($user->nama_instansi)]);
        });

   
        if ($search) {
            $query->where('tgl_keluhan', 'like', "%{$search}%");
        }

    } elseif ($user->role === 'admin') {
        
        if ($search) {
            $query->where('klien', 'like', "%{$search}%");
        }
    }

    $kliens = $query->paginate(10)->appends(['search' => $search]);

    return view('kliens.index', compact('kliens'));
}
public function create(Request $request)
{
    $user = auth()->user();
    $unitDefault = $request->input('unit', $user->nama_instansi);
    
    $lastTicket = Klien::where('id_tiket', 'like', 'TK%')
        ->where('user_id', $user->id)
        ->orderBy('id_tiket', 'desc')
        ->first();

    $nextNumber = $lastTicket ? str_pad(((int) substr($lastTicket->id_tiket, 2)) + 1, 2, '0', STR_PAD_LEFT) : '01';
    $newTicketId = 'TK' . $nextNumber;

  
    $teknisis = User::where('role', 'teknisi')
        ->where('nama_instansi', $unitDefault)
        ->get();

    $singleTeknisi = $teknisis->count() === 1 ? $teknisis->first() : null;

    return view('kliens.create', compact('teknisis', 'newTicketId', 'unitDefault', 'singleTeknisi'));
}

public function createSiswa()
{
    $users = User::whereNotNull('nama_instansi')
        ->where('role', 'user')
        ->select('id', 'nama_instansi')
        ->get();

    $sekolahTeknisiMap = User::where('role', 'teknisi')
        ->get()
        ->mapWithKeys(function ($teknisi) {
            return [
                $teknisi->nama_instansi => [
                    'id' => $teknisi->id,
                    'nama' => $teknisi->name,
                    'email' => $teknisi->email,
                ],
            ];
        });
  
    $selectedInstansi = request('nama_instansi');

    $newTicketId = null;

    if ($selectedInstansi) {
        $lastTicket = Klien::where('nama_instansi', $selectedInstansi)->orderBy('id', 'desc')->first();
        $nextId = optional($lastTicket)->id + 1;
        $newTicketId = 'TK' . str_pad($nextId, 2, '0', STR_PAD_LEFT);
    }

    return view('kliens.create-siswa', compact('users', 'newTicketId', 'sekolahTeknisiMap', 'selectedInstansi'));
}


public function generateIdByInstansi($instansi)
{
  
    $latest = Klien::where('nama_instansi', $instansi)->latest()->first();

    $number = $latest ? intval(substr($latest->id_tiket, -3)) + 1 : 1;

  
    $newTicketId = strtoupper(substr($instansi, 0, 3)) . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);

    
    \Log::info("Generated Ticket ID for Instansi $instansi: $newTicketId");

    return response()->json(['newTicketId' => $newTicketId]);
}

public function store(Request $request)
{
    $rules = [
        'keluhan' => 'required|string|max:255',
        'klien' => 'required|string|max:255',
        'deskripsi' => 'nullable|string|max:255',
        'tgl_keluhan' => 'required|date',
        'jam' => 'nullable|date_format:H:i',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        'nama_instansi' => $request->unit === 'Siswa' ? 'required|string|max:255' : 'nullable|string|max:255',
        'nama_pelapor' => 'nullable|string|max:255',
    ];

    $validated = $request->validate($rules);

    $teknisi = null;
    $userId = null;

    if ($request->unit === 'Siswa') {
        $teknisi = User::where('role', 'teknisi')
            ->where('nama_instansi', $request->nama_instansi)
            ->first();

        if (!$teknisi) {
            return back()->withErrors(['nama_instansi' => 'Teknisi untuk instansi ini belum tersedia.']);
        }

        $userId = User::where('nama_instansi', $request->nama_instansi)
            ->where('role', 'user')
            ->value('id');

        if (!$userId) {
            return back()->withErrors(['nama_instansi' => 'User dengan instansi ini tidak ditemukan.']);
        }
    } else {
        $user = auth()->user();

        if (!$user) {
            return back()->withErrors(['user_id' => 'User tidak terautentikasi.']);
        }

        $userId = $user->id;

      
        $teknisi = User::where('role', 'teknisi')
            ->where('nama_instansi', $user->nama_instansi)
            ->first();
    }

    $jumlahTiket = Klien::where('user_id', $userId)->count();
    $newTicketId = 'TK' . str_pad($jumlahTiket + 1, 2, '0', STR_PAD_LEFT);
    $filePathGambar = $request->file('gambar')?->store('post-images', 'public');

    $data = [
        'id_tiket' => $newTicketId,
        'user_id' => $userId,
        'teknisi_id' => $teknisi->id ?? null,
        'klien' => $request->klien,
        'keluhan' => $request->keluhan,
        'deskripsi' => $request->deskripsi,
        'tgl_keluhan' => $request->tgl_keluhan,
        'jam' => $request->jam,
        'gambar' => $filePathGambar,
        'nama_instansi' => $request->unit === 'Siswa' ? $request->nama_instansi : ($user->nama_instansi ?? null),
        'nama_pelapor' => $request->nama_pelapor ?? null,
        'unit' => $request->unit ?? 'Siswa',
    ];

    Klien::create($data);

    
    if ($teknisi) {
        Mail::to($teknisi->email)->send(new KeluhanNotification($data, route('teknisi.login.form')));
    }

    return ($request->unit === 'Siswa')
        ? redirect()->route('welcome')->with('success', 'Keluhan berhasil dibuat!')
        : redirect()->route('kliens.index')->with('success', 'Data berhasil ditambahkan.');
}

    public function edit($id)
    {
        $klien = Klien::findOrFail($id);
        return view('kliens.edit', compact('klien'));
        return view('kliens.edit', compact('klien', 'teknisis'));
    }

    public function show($id)
    {
        $klien = Klien::with('teknisi')->findOrFail($id);
        $teknisi = $klien->teknisi; 
    
        if ($klien->tgl_perbaikan && $klien->jam_perbaikan) {
            $tgl_keluhan = Carbon::parse($klien->tgl_keluhan . ' ' . $klien->jam);
            $tgl_perbaikan = Carbon::parse($klien->tgl_perbaikan . ' ' . $klien->jam_perbaikan);
            $durasi_hari = $tgl_keluhan->diffInDays($tgl_perbaikan);
            $durasi_jam = $tgl_keluhan->diffInHours($tgl_perbaikan) % 24;
        } else {
            $durasi_hari = 0;
            $durasi_jam = 0;
        }
    
        return view('kliens.show', compact('klien', 'teknisi', 'durasi_hari', 'durasi_jam'));
    }

    public function update(Request $request, $id)
    {
        $klien = Klien::findOrFail($id);
        $user = auth()->user();
    
       
        if ($user->role === 'user') {
            $validated = $request->validate([
                'keluhan' => 'required|string|max:255',
                'deskripsi' => 'nullable|string|max:255',
                'tgl_keluhan' => 'required|date',
                'jam' => 'nullable|date_format:H:i',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            
            $klien->update($validated);
    
            if ($request->hasFile('gambar')) {
                Storage::disk('public')->delete($klien->gambar);
                $klien->gambar = $request->file('gambar')->store('post-images', 'public');
            }
    
            $klien->save();
            return redirect()->route('kliens.index')->with('success', 'Data berhasil diperbarui.');
        }
    
       
        $validated = $request->validate([
            'status' => 'required|in:Menunggu,Selesai',
            'deskripsi_perbaikan' => 'nullable|string|max:255',
            'tgl_perbaikan' => 'required|date',
            'durasi_perbaikan' => 'nullable|string|max:255',
            'teknisi_id' => 'nullable|exists:teknisis,id',
            'keluhan' => 'required|string|max:255',
            'klien' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tgl_keluhan' => 'required|date',
            'jam' => 'nullable|date_format:H:i',
        ]);
    
        $klien->update($validated);
    
        foreach (['gambar', 'gambar_perbaikan'] as $file) {
            if ($request->hasFile($file)) {
                Storage::disk('public')->delete($klien->$file);
                $klien->$file = $request->file($file)->store('post-images', 'public');
            }
        }
        $klien->save();
    
        return redirect()->route('kliens.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $klien = Klien::findOrFail($id);
        Storage::disk('public')->delete($klien->gambar);
        $klien->delete();
        return redirect()->route('kliens.index')->with('success', 'Data berhasil dihapus!');

    }

    public function updateStatus($id)
    {
        $klien = Klien::findOrFail($id);
        $klien->status = $klien->status === 'Menunggu' ? 'Selesai' : 'Menunggu';
        $klien->save();
        return redirect()->route('kliens.index')->with('success', 'Status berhasil diperbarui');

    }
    public function riwayat(Request $request)
    {
        $user = auth()->user();
    
        $query = Klien::with('user')->where('status', 'Selesai');
    
       
        if (in_array($user->role, ['user', 'teknisi'])) {
            $query->whereHas('user', function ($q) use ($user) {
                $q->where('nama_instansi', $user->nama_instansi);
            });
        }
    
     
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tgl_keluhan', [$request->start_date, $request->end_date]);
        }
          $daftar_instansi = [];
        if ($user->role === 'admin') {
            $daftar_instansi = \App\Models\User::select('nama_instansi')->distinct()->pluck('nama_instansi');
        }
    
        if ($user->role === 'admin' && $request->nama_instansi) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('nama_instansi', $request->nama_instansi);
            });
        }
    
        $riwayat = $query->orderBy('tgl_keluhan', 'desc')->paginate(10);
    
        return view('kliens.riwayat', compact('riwayat', 'daftar_instansi'));
    }
    
    public function exportPdf(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
    
        $kliens = Klien::whereBetween('created_at', [$start_date, $end_date])->get();
    
        $pdf = Pdf::loadView('kliens.export-pdf', compact('kliens', 'start_date', 'end_date'));
    
        return $pdf->download('data_kliens.pdf');
    }
    
    }        
    
   