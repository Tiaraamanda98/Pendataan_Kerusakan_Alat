@extends('layouts.app')

@section('content')
<br>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-0 text-center">EDIT TEKNISI</h3>
            <br>
            <form action="{{ route('teknisis.update', $teknisi->id) }}" method="POST">
                @csrf
                @method('PUT')  

                <div class="mb-3">
                    <label for="nama_teknisi" class="form-label">Nama Teknisi:</label>
                    <input type="text" name="nama_teknisi" class="form-control" value="{{ old('nama_teknisi', $teknisi->nama_teknisi) }}" required>
                </div>

                <div class="mb-3">
                    <label for="no_telp" class="form-label">No Telepon:</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $teknisi->no_telp) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $teknisi->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>

                <input type="hidden" name="role" value="teknisi">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update 
                </button>
                <a href="{{ route('teknisis.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
