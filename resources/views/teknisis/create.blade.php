@extends('layouts.app')

@section('content')
<br>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-0 text-center">TAMBAH TEKNISI</h3>
            <br>
            <form action="{{ route('teknisis.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Teknisi:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="no_telp" class="form-label">No Telepon:</label>
                    <input type="number" name="no_telp" class="form-control" required>
                </div>


                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="text" name="password" class="form-control" required>
                </div>

                <input type="hidden" name="role" value="teknisi">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan 
                </button>
                <a href="{{ route('teknisis.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
