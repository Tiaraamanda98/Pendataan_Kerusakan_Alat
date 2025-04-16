@extends('layouts.app')
@section('content')
<br>
<br>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0 text-center flex-grow-1">DAFTAR KELUHAN</h3>

                <form action="{{ route('kliens.index') }}" method="GET" class="d-flex" style="max-width: 400px;">
                    <input type="text" name="search" class="form-control me-2"
                        placeholder="@if(auth()->user()->role === 'admin') Cari berdasarkan klien @else Cari berdasarkan tanggal  @endif"
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>

            @if(auth()->user()->role == 'user')
                <a href="{{ route('kliens.create') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-plus me-1"></i> Tambah Keluhan
                </a>
            @endif
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-center" style="width: 100%;">
                <thead style="background-color: #485cbc; color: white;">
                    <tr>
                        <th>No</th>
                        <th>ID Tiket</th>
                        <th>Klien</th>
                        <th>Unit</th>
                        <th>Keluhan</th>
                        <th>Deskripsi</th>
                        <th>Tgl Keluhan</th>
                        <th>Jam</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kliens as $klien)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>#{{ $klien->id_tiket }}</strong></td>
                            <td>{{ $klien->klien }}</td>
                            <td>{{ $klien->unit }}</td>
                            <td>{{ $klien->keluhan }}</td>
                            <td>{{ $klien->deskripsi }}</td>
                            <td>{{ $klien->tgl_keluhan }}</td>
                            <td>{{ $klien->jam }}</td>
                            <td>
                                @if($klien->gambar)
                                    <img src="{{ asset('storage/' . $klien->gambar) }}" class="img-thumbnail img-preview" width="50" onclick="showImage('{{ asset('storage/' . $klien->gambar) }}')">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $klien->status == 'Menunggu' ? 'bg-warning' : 'bg-success' }}">
                                    {{ $klien->status }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('kliens.show', $klien->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    
                                    @if(auth()->user()->role == 'user' && auth()->user()->id == $klien->user_id || auth()->user()->role == 'admin' || auth()->user()->role == 'teknisi')
                                    <a href="{{ route('kliens.edit', $klien->id) }}" class="btn btn-warning">
                                      <i class="fas fa-edit"></i>
                                            @if(auth()->user()->role == 'teknisi')
                                                Respon
                                            @else
                                                Edit
                                            @endif
                                    </a>
                                
                                        <form action="{{ route('kliens.destroy', $klien->id) }}" method="POST" class="d-inline" id="delete-form-{{ $klien->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $klien->id }})">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $kliens->links() }}
        </div>
    </div>
</div>


<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pratinjau Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Gambar" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>

<script>
    function showImage(src) {
        document.getElementById('modalImage').setAttribute('src', src);
        new bootstrap.Modal(document.getElementById('imageModal')).show();
    }
</script>

<style>
    .img-preview {
        width: 50px;
        height: 50px;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.2s;
    }
    .img-preview:hover {
        transform: scale(1.2);
    }
    .table th, .table td {
        vertical-align: middle !important;
    }
    .btn-group .btn {
        padding: 10px 15px;
        font-size: 14px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
    @if(session('success'))
        Swal.fire({
            title: "Berhasil!",
            text: "{{ session('success') }}",
            icon: "success"
        });
    @endif
</script>
@endsection
