
@extends('layouts.app')
@section('content')
<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
      <h3 class="mb-0">Daftar Pengguna</h3>
      <br>
      <br>
      <div class="d-flex w-100 gap-2 align-items-center">
        <form action="{{ route('penggunas.index') }}" method="GET" class="d-flex flex-grow-1" style="max-width: 300px;">
            <input type="text" class="form-control me-2" name="search" placeholder="Cari" value="{{ old('search', $search ?? '') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
        <a href="{{ route('penggunas.create') }}" class="btn btn-success btn-sm rounded-pill ms-auto">+ Tambah Pengguna</a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-striped">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>No Telephone</th>
              <th>Email</th>
              <th>Password</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($penggunas as $key => $pengguna)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pengguna->nama }}</td>
                <td>{{ $pengguna->alamat }}</td>
                <td>{{ $pengguna->no_telp }}</td>
                <td>{{ $pengguna->email }}</td>
                <td>{{ $pengguna->password }}</td>
                <td>
                  <div class="d-flex">
                    <a href="{{ route('penggunas.edit', $pengguna->id) }}" class="btn btn-warning btn-sm me-2 rounded-pill">Edit</a>
                    <form action="{{ route('penggunas.destroy', $pengguna->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm rounded-pill">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center">Tidak ada data pengguna.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection