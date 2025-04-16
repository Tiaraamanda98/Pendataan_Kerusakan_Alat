@extends('layouts.app')

@section('content')
<br>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-0 text-center">COVER</h3>
            <br>
            <a href="{{ route('covers.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Cover
            </a>   
            <br><br>

            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center" style="width: 100%;">
                    <thead style="background-color: #485cbc; color: white;">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Logo Instansi</th>
                            <th>Logo Umum</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($covers as $index => $cover)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $cover->judul }}</td>
                                <td>
                                    @if($cover->logo_instansi)
                                        <img src="{{ asset('storage/' . $cover->logo_instansi) }}" 
                                             class="img-thumbnail img-preview" 
                                             width="50" 
                                             style="cursor: pointer;"
                                             onclick="showImage('{{ asset('storage/' . $cover->logo_instansi) }}')">
                                    @else
                                        Tidak ada logo
                                    @endif
                                </td>
                                <td>
                                @if($cover->logo_umum)
                                    <img src="{{ asset('storage/' . $cover->logo_umum) }}" 
                                        class="img-thumbnail img-preview" 
                                        width="50" 
                                        style="cursor: pointer;"
                                        onclick="showImage('{{ asset('storage/' . $cover->logo_umum) }}')"
                                        alt="Logo Umum">
                                @else
                                    <span class="text-muted">Tidak ada logo</span>
                                @endif
                            </td>

                                <td>
                                    <a href="{{ route('covers.edit', $cover->id) }}" class="btn btn-warning">Edit</a>
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $cover->id }})">Hapus</button>
                                    <form id="delete-form-{{ $cover->id }}" action="{{ route('covers.destroy', $cover->id) }}" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pratinjau Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" style="max-height: 400px; border-radius: 8px;">
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showImage(imageUrl) {
        const modalImage = document.getElementById("modalImage");
        modalImage.src = imageUrl;
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    }

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
</script>
@endpush
