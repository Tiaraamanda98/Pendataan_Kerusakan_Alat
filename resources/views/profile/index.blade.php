@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered">  
            <h3 class="mb-0 text-center">PROFIL SAYA</h3>
        <br>
        
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-borderless">
                    <tr>
                        <th>Nama</th>
                        <td>
                            @if(auth()->user()->role === 'teknisi')
                                {{ $user->name }}
                            @else
                                {{ $user->nama_instansi }}
                            @endif
                        </td>
                    </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $user->alamat ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td>{{ $user->no_telp ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <th>Foto Profil</th>
                            <td>
                                @if($user->foto_profil)
                                    <img src="{{ asset('storage/' . $user->foto_profil) }}" class="img-thumbnail" width="100">
                                @else
                                    Belum diunggah
                                @endif
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
