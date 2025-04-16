@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered">  
            <h3 class="mb-0 text-center">EDIT PROFIL SAYA</h3>
        <br>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="table table-bordered">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                </div>

                <div class="mb-3">
                    <label for="alamat" class="table table-bordered">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $user->alamat) }}">
                </div>

                <div class="mb-3">
                    <label for="no_telp" class="form-label">No. Telepon</label>
                    <input type="number" name="no_telp" class="form-control" value="{{ old('no_telp', $user->no_telp) }}">
                </div>

                <div class="mb-3">
                <label for="foto_profil" class="form-label">Foto Profil</label>
                <input type="file" name="foto_profil" class="form-control">
                
                @if($user->foto_profil)
                    <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Gambar" width="100" class="mt-2">
                @else
                    <p>Tidak ada gambar</p>
                @endif
            </div>


            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>
            </div>

            </form>
        </div>
    </div>
</div>
@endsection
