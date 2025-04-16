<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'alamat' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

       
    if ($request->hasFile('foto_profil')) {
       
        if ($user->foto_profil) {
            Storage::delete('public/' . $user->foto_profil);
        }

        $path = $request->file('foto_profil')->store('post-images', 'public');
        $user->foto_profil = $path;
    }

        $user->alamat = $request->alamat;
        $user->no_telp = $request->no_telp;
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
