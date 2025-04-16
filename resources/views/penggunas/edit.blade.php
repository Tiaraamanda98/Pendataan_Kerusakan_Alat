
@extends('layouts.app')
@section('content')
    <title>@yield('title', 'Pengguna')</title>
   
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Pengguna</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('penggunas.update', $pengguna->id) }}" method="POST">
                @csrf
                @method('PUT')

         <div class="mb-3">
             <label for="nama" class="form-label">Nama</label>
                 <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $pengguna->nama) }}" placeholder="Masukkan nama">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
         </div>

         <div class="mb-3">
               <label for="alamat" class="form-label">Alamat</label>
                  <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat', $pengguna->alamat) }}" placeholder="Masukkan alamat">
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
          </div>
                
         <div class="mb-3">
                 <label for="no_telp" class="form-label">No Telepon</label>
                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" value="{{ old('no_telp', $pengguna->no_telp) }}" placeholder="Masukkan no telepon">
                    @error('no_telp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
         </div>

        <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $pengguna->email) }}" placeholder="Masukkan email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
      </div>

        <div class="mb-3">
                <label for="password" class="form-label">Alamat</label>
                  <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password', $pengguna->password) }}" placeholder="Masukkan password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
      </div>
               
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('penggunas.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection