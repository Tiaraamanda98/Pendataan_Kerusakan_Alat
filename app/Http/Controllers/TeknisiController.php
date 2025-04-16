<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\TeknisiAccountNotification;
use Illuminate\Support\Facades\Mail;

class TeknisiController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $teknisis = User::where('role', 'teknisi')->paginate(10);
        } else {
            $teknisis = User::where('role', 'teknisi')
                ->where('nama_instansi', $user->nama_instansi)
                ->paginate(10);
        }

        return view('teknisis.index', compact('teknisis'));
    }

    public function create()
    {
        return view('teknisis.create');
    }

  public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_telp' => 'required|numeric',
            'password' => 'required|string',
        ]);

        $plainPassword = $request->password;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'nama_instansi' => auth()->user()->nama_instansi,
            'role' => 'teknisi',
            'password' => \Hash::make($plainPassword),
        ]);

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $plainPassword,
        ];
        $loginUrl = route('login'); // atau bisa diganti dengan URL custom login kamu

        Mail::to($user->email)->send(new TeknisiAccountNotification($data, $loginUrl));

        return redirect()->route('teknisis.index')->with('success', 'Teknisi berhasil ditambahkan dan email dikirim!');
    }
    
    public function edit(User $teknisi)
    {
        return view('teknisis.edit', compact('teknisi'));
    }

    public function update(Request $request, User $teknisi)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teknisi->id,
            'no_telp' => 'nullable|string',
            'nama_instansi' => 'required|string|max:255',
            'password' => 'nullable|string|confirmed',
        ]);

        $data = $request->only('name', 'email', 'no_telp', 'nama_instansi');
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $teknisi->update($data);

        return redirect()->route('teknisis.index')->with('success', 'Data teknisi berhasil diperbarui!');
    }

    public function destroy(User $teknisi)
    {
        $teknisi->delete();
        return redirect()->route('teknisis.index')->with('success', 'Teknisi berhasil dihapus!');
    }
}
