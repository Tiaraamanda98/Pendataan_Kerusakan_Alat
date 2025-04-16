@extends('layouts.app')

@section('content')
<br>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-0 text-center">EDIT COVER</h3>
            <br>
            <form action="{{ route('covers.update', $cover->id) }}" method="POST" enctype="multipart/form-data"> 
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ $cover->judul }}" required>
                </div>

                <div class="mb-3">
                    <label for="logo_instansi" class="form-label">Logo Instansi</label>
                    <input type="file" name="logo_instansi" class="form-control">
                    @if($cover->logo_instansi)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $cover->logo_instansi) }}" 
                                 class="img-thumbnail img-preview" width="100">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="logo_umum" class="form-label">Logo Umum</label>
                    <input type="file" name="logo_umum" class="form-control">
                    @if($cover->logo_umum)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $cover->logo_umum) }}" 
                                 class="img-thumbnail img-preview" width="100">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('covers.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
