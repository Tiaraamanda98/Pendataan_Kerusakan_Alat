@extends('layouts.app')

@section('title', 'Klien')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Tambah Keluhan</h3>
        </div>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <div class="card-body">
            <form action="{{ route('kliens.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

            <div class="mb-3">
                <label for="id_tiket" class="form-label">ID Tiket</label>
                <input type="text" class="form-control" id="id_tiket" name="id_tiket" value="{{ old('id_tiket', $newTicketId) }}" readonly>
            </div>


            <div class="mb-3">
                 <label for="klien" class="form-label">Klien</label>
                 <input type="text" class="form-control" id="klien" name="klien" value="{{ Auth::user()->nama_instansi}}" readonly>
            </div>

            @if ($singleTeknisi)
                {{-- Jika teknisi hanya satu --}}
                <input type="hidden" name="teknisi_id" value="{{ $singleTeknisi->id }}">
                <div class="form-group">
                    <label>Teknisi</label>
                    <input type="text" class="form-control" value="{{ $singleTeknisi->name }}" readonly>
                </div>

                <div class="form-group">
                    <label>Email Teknisi</label>
                    <input type="text" class="form-control" value="{{ $singleTeknisi->email }}" readonly>
                </div>

                @else
                <div class="form-group">
                    <label for="teknisi_id">Pilih Teknisi</label>
                    <select name="teknisi_id" id="teknisi_id" class="form-control" required>
                        <option value="">-- Pilih Teknisi --</option>
                        @foreach ($teknisis as $teknisi)
                            <option value="{{ $teknisi->id }}">{{ $teknisi->name }}</option>
                        @endforeach
                    </select>
                </div>

            <div class="form-group">
                <label for="nama_teknisi">Nama Teknisi</label>
                <input type="text" id="nama_teknisi" class="form-control" readonly>
            </div>

  
            <div class="form-group">
                <label for="email_teknisi">Email Teknisi</label>
                <input type="text" id="email_teknisi" class="form-control" readonly>
            </div>

            <script>
                const teknisiData = @json($teknisis);
                const select = document.getElementById('teknisi_id');
                const namaInput = document.getElementById('nama_teknisi');
                const emailInput = document.getElementById('email_teknisi');

                select.addEventListener('change', function () {
                    const selectedId = this.value;
                    const teknisi = teknisiData.find(t => t.id == selectedId);
                    if (teknisi) {
                        namaInput.value = teknisi.name;
                        emailInput.value = teknisi.email;
                    } else {
                        namaInput.value = '';
                        emailInput.value = '';
                    }
                });
            </script>
        @endif


            <div class="mb-3">
                <label for="nama_pelapor" class="form-label">Nama User</label>
                <input type="text" class="form-control @error('nama_pelapor') is-invalid @enderror" id="nama_pelapor" name="nama_pelapor" value="{{ old('nama_pelapor') }}" placeholder="Masukkan nama user">
                    @error('nama_pelapor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
           </div>
                              
            <div class="mb-3">
                 <label for="unit" class="form-label">Unit</label>
                <select class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" onchange="toggleCustomUnit(this.value)">
                <option value="">Pilih unit</option>
                <option value="Unit Pendidikan" {{ old('unit') == 'Unit Pendidikan' ? 'selected' : '' }}>Unit Pendidikan</option>
                <option value="Unit Tata Usaha" {{ old('unit') == 'Unit Tata Usaha' ? 'selected' : '' }}>Unit Tata Usaha</option>
                <option value="Unit Kebersihan" {{ old('unit') == 'Unit Kebersihan' ? 'selected' : '' }}>Unit Kebersihan</option>
                <option value="Unit Prasana dan Sarana" {{ old('unit') == 'Unit Prasana dan Sarana' ? 'selected' : '' }}>Unit Prasana dan Sarana</option>
                <option value="Unit Keamanan" {{ old('unit') == 'Unit Keamanan ' ? 'selected' : '' }}>Unit Keamanan</option>
                <option value="Lainnya" {{ old('unit') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('unit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3" id="custom-unit-container" style="display: none;">
                <label for="custom_unit" class="form-label">Tulis Nama Unit Sesuai Kebutuhan</label>
                <input type="text" class="form-control" name="custom_unit" id="custom_unit" value="{{ old('custom_unit') }}">
            </div>

            <script>
                function toggleCustomUnit(value) {
                    const customUnitInput = document.getElementById('custom-unit-container');
                    if (value === 'Lainnya') {
                        customUnitInput.style.display = 'block';
                    } else {
                        customUnitInput.style.display = 'none';
                    }
                }
                document.addEventListener("DOMContentLoaded", function() {
                    toggleCustomUnit(document.getElementById('unit').value);
                });
            </script>


             <div class="mb-3">
                 <label for="keluhan" class="form-label">Keluhan</label>
                 <input type="text" class="form-control @error('keluhan') is-invalid @enderror" id="keluhan" name="keluhan" value="{{ old('keluhan') }}" placeholder="Masukkan keluhan">
                    @error('keluhan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>

            <div class="mb-3">
                 <label for="deskripsi" class="form-label">Deskripsi</label>
                 <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>

            <div class="mb-3">
                <label for="tgl_keluhan" class="form-label">Tanggal Keluhan</label>
                <input type="date" class="form-control @error('tgl_keluhan') is-invalid @enderror" id="tgl_keluhan" name="tgl_keluhan" value="{{ old('tgl_keluhan', date('Y-m-d')) }}">
                    @error('tgl_keluhan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
           </div>

            <div class="mb-3">
                <label for="jam" class="form-label">Jam</label>
                <input type="time" class="form-control @error('jam') is-invalid @enderror" id="jam" name="jam" value="{{ old('jam', date('H:i')) }}">
                    @error('jam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>

                <script>
                    window.onload = function () {
                        const now = new Date();
                        const hours = now.getHours().toString().padStart(2, '0');
                        const minutes = now.getMinutes().toString().padStart(2, '0');
                        document.getElementById('jam').value = hours + ':' + minutes;
                    };
                </script>

    
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <div class="input-group">
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                        <button class="btn btn-primary d-flex align-items-center" type="button" id="captureBtn">
                            <i class="fa fa-camera me-2"></i> Ambil Foto
                        </button>
                    </div>
                    <video id="video" width="100%" autoplay style="display: none;"></video>
                    <canvas id="canvas" style="display: none;"></canvas>
                    <button class="btn btn-success mt-2" id="takePhotoBtn" style="display: none;">Ambil Foto</button>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <script>
                    document.getElementById('captureBtn').addEventListener('click', function () {
                        const video = document.getElementById('video');
                        const takePhotoBtn = document.getElementById('takePhotoBtn');

                        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                            navigator.mediaDevices.getUserMedia({ video: true })
                                .then(function (stream) {
                                    video.srcObject = stream;
                                    video.style.display = "block";
                                    takePhotoBtn.style.display = "block";
                                })
                                .catch(function (error) {
                                    alert("Kamera tidak bisa diakses: " + error);
                                });
                        } else {
                            alert("Browser tidak mendukung akses kamera");
                        }
                    });

                    document.getElementById('takePhotoBtn').addEventListener('click', function () {
                        const video = document.getElementById('video');
                        const canvas = document.getElementById('canvas');
                        const context = canvas.getContext('2d');

                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);

                        canvas.toBlob(function (blob) {
                            const file = new File([blob], "captured-image.jpg", { type: "image/jpeg" });
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file);
                            document.getElementById('gambar').files = dataTransfer.files;

                            video.style.display = "none";
                            document.getElementById('takePhotoBtn').style.display = "none";
                        });
                    });
                </script>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('kliens.index') }}" class="btn btn-primary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
