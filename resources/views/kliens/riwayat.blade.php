@extends('layouts.app')

@section('content')
<br><br>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-0 text-center">DAFTAR RIWAYAT</h3>
        </div>

        <div class="card-body">
            <form method="GET" action="{{ route('kliens.riwayat') }}">
         <br>

         <div class="row mb-3">
              <div class="col-md-3">
             <label for="start_date" class="form-label">Dari Tanggal</label>
             <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>

        <div class="col-md-3">
            <label for="end_date" class="form-label">Sampai Tanggal</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>

       
        @if(auth()->user()->role == 'admin')
        <div class="col-md-4">
            <label for="nama_instansi" class="form-label">Nama Instansi</label>
            <select name="nama_instansi" id="nama_instansi" class="form-control">
                <option value="">--Cari Nama Instansi--</option>
                @foreach ($daftar_instansi as $instansi)
                    <option value="{{ $instansi }}" {{ request('nama_instansi') == $instansi ? 'selected' : '' }}>
                        {{ $instansi }}
                    </option>
                @endforeach
            </select>
        </div>
        @endif

        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Cari</button>
        </div>
    </div>

 
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="{{ route('riwayat.cetak-pdf', [
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
            'nama_instansi' => request('nama_instansi')
        ]) }}" class="btn btn-danger">
            Cetak PDF
        </a>
    </div>

    
        @if(session('cover_error') || session('tanggal_error'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: '{{ session('cover_error') ?? session('tanggal_error') }}',
                });
            </script>
        @endif
    </form>


            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center" style="width: 100%;">
                    <thead style="background-color: #485cbc; color: white;">
                        <tr>
                            <th>No</th>
                            <th>ID Tiket</th>
                            <th>Keluhan</th>
                            <th>Klien</th>
                            <th>Unit</th>
                            <th>Deskripsi</th>
                            <th>Tgl Keluhan</th>
                            <th>Instansi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($riwayat as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>#{{ $item->id_tiket }}</strong></td>
                                <td>{{ $item->keluhan }}</td>
                                <td>{{ $item->klien }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->tgl_keluhan }}</td>
                                <td>{{ $item->user->nama_instansi ?? '-' }}</td>
                                <td><span class="badge bg-success">{{ $item->status }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">Tidak ada riwayat keluhan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $riwayat->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
