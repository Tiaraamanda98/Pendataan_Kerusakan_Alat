@extends('layouts.app')
@section('content')
    <title>@yield('title', 'Klien Admin')</title>

    <div class="container mt-5">
         <div class="card">
        <div class="card-header">
         <h3>
                @if(auth()->user()->role === 'teknisi' || auth()->user()->role === 'admin')
                    Tanggapi Keluhan Klien
                @else
                    Edit Keluhan
                @endif
         </h3>
        </div>

        <div class="card-body">
            <form action="{{ route('kliens.update', $klien->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

        <div class="mb-3">
             <label for="klien" class="form-label">Klien</label>
             <input type="text" class="form-control" id="klien" name="klien" value="{{ old('klien', $klien->klien) }}" readonly>
        </div>

                    
        @isset($teknisi)
            <input type="hidden" name="teknisi_id" value="{{ $teknisi->id }}">

            <div class="mb-3">
                <label class="form-label">Nama Teknisi</label>
                <input type="text" class="form-control" value="{{ $teknisi->nama_teknisi }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Teknisi</label>
                <input type="email" class="form-control" value="{{ $teknisi->email }}" readonly>
            </div>

            @elseif(isset($teknisis) && $teknisis->count())
                @if($teknisis->count() === 1 || auth()->user()->role != 'admin')
                    {{-- Hanya ada satu teknisi atau role bukan admin → readonly --}}
                    @php $t = $teknisis->first(); @endphp
                    <input type="hidden" name="teknisi_id" value="{{ $t->id }}">

            <div class="mb-3">
                <label class="form-label">Nama Teknisi</label>
                <input type="text" class="form-control" value="{{ $t->nama_teknisi }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Teknisi</label>
                <input type="email" class="form-control" value="{{ $t->email }}" readonly>
            </div>
            @else
      
        <div class="mb-3">
            <label for="teknisi_id" class="form-label">Nama Teknisi</label>
            <select name="teknisi_id" id="teknisi_id" class="form-control" required>
                <option value="">-- Pilih Teknisi --</option>
                @foreach($teknisis as $t)
                    <option value="{{ $t->id }}" data-email="{{ $t->email }}"
                        {{ (old('teknisi_id', $data->teknisi_id ?? $klien->teknisi_id ?? '') == $t->id) ? 'selected' : '' }}>
                        {{ $t->nama_teknisi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Teknisi</label>
            <input type="email" id="email_teknisi" class="form-control" 
                value="{{ old('email_teknisi', $data->teknisi->email ?? $klien->teknisi->email ?? '') }}" readonly>
        </div>

     
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const selectTeknisi = document.getElementById('teknisi_id');
                const emailInput = document.getElementById('email_teknisi');

                function updateEmail() {
                    const selected = selectTeknisi.options[selectTeknisi.selectedIndex];
                    emailInput.value = selected.getAttribute('data-email') || '';
                }

                selectTeknisi.addEventListener('change', updateEmail);
                updateEmail();
            });
        </script>
            @endif
        @endif


        <div class="mb-3">
            <label for="nama_pelapor" class="form-label">Nama User</label>
            <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor"
                value="{{ old('nama_pelapor', $klien->nama_pelapor) }}" readonly>
        </div>


        <div class="mb-3">
            <label for="unit" class="form-label">Unit</label>
            <input type="text" class="form-control" id="unit" name="unit" value="{{ old('unit', $klien->unit) }}" readonly>
        </div>


        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan</label>
            <input type="text" class="form-control" id="keluhan" name="keluhan" value="{{ old('keluhan', $klien->keluhan) }}" {{ auth()->user()->role == 'user' ? '' : 'readonly' }}>
        </div>


        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" {{ auth()->user()->role == 'user' ? '' : 'readonly' }}>{{ old('deskripsi', $klien->deskripsi) }}</textarea>
        </div>


        <div class="mb-3">
            <label for="tgl_keluhan" class="form-label">Tanggal Keluhan</label>
            <input type="date" class="form-control" id="tgl_keluhan" name="tgl_keluhan" value="{{ old('tgl_keluhan', $klien->tgl_keluhan) }}" {{ auth()->user()->role == 'user' ? '' : 'readonly' }}>
        </div>


        <div class="mb-3">
            <label for="jam" class="form-label">Jam</label>
            <input type="time" class="form-control" id="jam" name="jam" 
            value="{{ old('jam', isset($klien->jam) ? \Carbon\Carbon::parse($klien->jam)->setTimezone('Asia/Jakarta')->format('H:i') : '') }}" {{ auth()->user()->role == 'user' ? '' : 'readonly' }}>
        </div>


        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Sebelum Perbaikan</label>
            <input type="file" class="form-control" id="gambar" name="gambar" {{ auth()->user()->role == 'user' ? '' : 'disabled' }}>
            @if($klien->gambar)
                <img src="{{ asset('storage/' . $klien->gambar) }}" alt="Gambar" width="100" class="mt-2">
            @else
                <p>Tidak ada gambar</p>
            @endif
        </div>


                
         @if(auth()->user()->role != 'user')
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
                <div class="mb-3">
                     <label for="gambar_perbaikan" class="form-label">Gambar Setelah Perbaikan</label>
                      <div class="input-group">
                        <input type="file" class="form-control" id="gambar_perbaikan" name="gambar_perbaikan">
                        <button class="btn btn-primary d-flex align-items-center" type="button" id="captureBtn">
                            <i class="fa fa-camera me-2"></i>
                        </button>
                    </div>
                    @if($klien->gambar_perbaikan)
                        <img src="{{ asset('storage/' . $klien->gambar_perbaikan) }}" alt="Gambar Perbaikan" width="100" class="mt-2">
                    @endif
                </div>

                <script>
                document.getElementById('captureBtn').addEventListener('click', function() {
                    document.getElementById('gambar_perbaikan').click();
                });
                </script>
                @endif

                @if(auth()->user()->role != 'user')
                <div class="mb-3">
                    <label for="deskripsi_perbaikan" class="form-label">Deskripsi Perbaikan</label>
                    <textarea class="form-control" id="deskripsi_perbaikan" name="deskripsi_perbaikan" rows="3">{{ old('deskripsi_perbaikan', $klien->deskripsi_perbaikan) }}</textarea>
                </div>
                @endif

            
                @if(auth()->user()->role != 'user')
                <div class="mb-3">
                    <label for="tgl_perbaikan" class="form-label">Tanggal Perbaikan</label>
                    <input type="date" class="form-control" id="tgl_perbaikan" name="tgl_perbaikan" value="{{ old('tgl_perbaikan', now()->toDateString()) }}">
                </div>

               
                <div class="mb-3">
                    <label for="durasi_perbaikan" class="form-label">Durasi Perbaikan</label>
                    <input type="text" class="form-control" id="durasi_perbaikan" name="durasi_perbaikan" value="{{ old('durasi_perbaikan') }}">
                </div>
                @endif

                <form action="{{ route('kliens.update', $klien->id) }}" method="POST">
                @csrf
                @method('PUT')

 
                @if(auth()->user()->role != 'user')
                    <div class="mb-3">
                        <label class="form-label fw-bold d-block">Status</label>
                        
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="statusMenunggu" value="Menunggu" 
                    {{ $klien->status == 'Menunggu' ? 'checked' : '' }}>
                <label class="form-check-label" for="statusMenunggu">Menunggu</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="statusSelesai" value="Selesai" 
                    {{ $klien->status == 'Selesai' ? 'checked' : '' }}>
                <label class="form-check-label" for="statusSelesai">Selesai</label>
            </div>
            </div>
             @endif


            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('kliens.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
