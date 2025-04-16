@extends('layouts.app')

@section('content')
<br>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-0 text-center">DAFTAR TEKNISI</h3>
            <br>
            <a href="{{ route('teknisis.create') }}" class="btn btn-primary deafult-pill">
                <i class="fas fa-plus me-1"></i> Tambah Teknisi
            </a>   
            <br> 
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center" style="width: 100%;">
                    <thead style="background-color: #485cbc; color: white;">
                        <br>
                        <br>
                        <tr>
                            <th>Nama Teknisi</th>
                            <th>No Telepon</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teknisis as $teknisi)
                            <tr>
                                <td>{{ $teknisi->name }}</td> 
                                <td>{{ $teknisi->no_telp }}</td>
                                <td>{{ $teknisi->email }}</td>
                                <td>{{ $teknisi->password }}</td> 
                                <td>
                                    <a href="{{ route('teknisis.edit', $teknisi->id) }}" class="btn btn-warning">Edit</a>
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $teknisi->id }})">Hapus</button>
                                    <form id="delete-form-{{ $teknisi->id }}" action="{{ route('teknisis.destroy', $teknisi->id) }}" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-3">
                    {{ $teknisis->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

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
