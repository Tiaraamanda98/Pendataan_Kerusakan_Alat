@extends('layouts.app')

@section('content')
<br>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-0 text-center">TAMBAH COVER</h3>
            <br>
            <form action="{{ route('covers.store') }}" method="POST" enctype="multipart/form-data"> 
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="logo_instansi" class="form-label">Logo Instansi</label>
                    <input type="file" name="logo_instansi" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="logo_umum" class="form-label">Logo Umum</label>
                    <input type="file" name="logo_umum" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan 
                </button>
                <a href="{{ route('covers.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
