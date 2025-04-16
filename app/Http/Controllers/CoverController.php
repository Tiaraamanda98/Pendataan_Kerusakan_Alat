<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CoverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $user = auth()->user();

    if ($user->role == 'admin') {
        $covers = Cover::paginate(10); 
    } else {
        $covers = Cover::where('user_id', $user->id)->paginate(10); 
    }

    return view('covers.index', compact('covers'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('covers.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'logo_instansi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo_umum' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        
        $logoInstansiPath = $request->file('logo_instansi')?->store('post-images', 'public');
        $logoPath = $request->file('logo')?->store('post-images', 'public');
    
        Cover::create([
            'judul' => $request->judul,
            'logo_instansi' => $logoInstansiPath,
            'logo_umum' => $logoPath,
            'user_id' => auth()->id(), 
        ]);
        
        return redirect()->route('covers.index')->with('success', 'Data berhasil ditambahkan!');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cover  $cover
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cover  $cover
     * @return \Illuminate\Http\Response
     */
  
     public function edit(Cover $cover)
     {
         return view('covers.edit', compact('cover'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cover  $cover
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cover $cover)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'logo_instansi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo_umum' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
       
        if ($request->hasFile('logo_instansi')) {
            Storage::disk('public')->delete($cover->logo_instansi);
            $cover->logo_instansi = $request->file('logo_instansi')->store('post-images', 'public');
        }
    
        if ($request->hasFile('logo_umum')) {
            Storage::disk('public')->delete($cover->logo_umum);
            $cover->logo_umum = $request->file('logo_umum')->store('post-images', 'public');
        }
    
        // Update data
        $cover->update([
            'judul' => $request->judul,
            'logo_instansi' => $cover->logo_instansi,
            'logo_umum' => $cover->logo_umum,
        ]);
    
        return redirect()->route('covers.index')->with('success', 'Data berhasil diperbarui!');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cover  $cover
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cover $cover)
    {
        $cover->delete();
        return redirect()->route('covers.index')->with('success', 'Data berhasil dihapus!');
    }
}
