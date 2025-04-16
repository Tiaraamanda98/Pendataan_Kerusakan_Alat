@extends('layouts.app')

@section('content')

@if (session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

<title>@yield('title', 'Klien')</title>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Tambah Keluhan</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('kliens.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" id="user_id" value="">
                <input type="hidden" name="unit" value="Siswa">

                <div class="mb-3">
                    <label for="nama_instansi" class="form-label">Nama Instansi</label>
                    <select id="nama_instansi" name="nama_instansi" class="form-control">
                    <option value="" >--Pilih Instansi--</option>
                        @foreach($users as $user)
                            <option value="{{ $user->nama_instansi }}" {{ old('nama_instansi') == $user->nama_instansi ? 'selected' : '' }}>
                                {{ $user->nama_instansi }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-3">
                    <label for="nama_teknisi" class="form-label">Nama Teknisi</label>
                    <input type="text" class="form-control" id="nama_teknisi" name="nama_teknisi" readonly>
                </div>

                <div class="mb-3">
                    <label for="email_teknisi" class="form-label">Email Teknisi</label>
                    <input type="email" class="form-control" id="email_teknisi" name="email_teknisi" readonly>
                </div>

                <input type="hidden" name="teknisi_id" id="teknisi_id">

                <script>
                    const sekolahTeknisiMap = @json($sekolahTeknisiMap);

                    document.addEventListener('DOMContentLoaded', function () {
                        const instansiElement = document.getElementById('nama_instansi');
                        if (instansiElement) {
                            instansiElement.addEventListener('change', function () {
                                var selectedInstansi = this.value;
                                var teknisiData = sekolahTeknisiMap[selectedInstansi];

                                if (selectedInstansi) {
                                    fetch('/generate-id/' + encodeURIComponent(selectedInstansi))
                                        .then(response => response.json())
                                        .then(data => {
                                            document.getElementById('id_tiket').value = data.newTicketId || 'TK01';
                                        });

                                    if (teknisiData) {
                                        document.getElementById('nama_teknisi').value = teknisiData.nama;
                                        document.getElementById('email_teknisi').value = teknisiData.email;
                                        document.getElementById('teknisi_id').value = teknisiData.id;
                                    } else {
                                        document.getElementById('nama_teknisi').value = '';
                                        document.getElementById('email_teknisi').value = '';
                                        document.getElementById('teknisi_id').value = '';
                                    }
                                }
                            });
                        }
                    });
                </script>

                <div class="mb-3">
                    <label for="klien" class="form-label">Klien</label>
                    <input type="text" class="form-control" id="klien" name="klien" value="Siswa" readonly>
                </div>

                <div class="mb-3">
                    <label for="nama_pelapor" class="form-label">Nama User</label>
                    <input type="text" class="form-control @error('nama_pelapor') is-invalid @enderror" id="nama_pelapor" name="nama_pelapor" value="{{ old('nama_pelapor') }}" placeholder="Masukkan nama user">
                    @error('nama_pelapor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

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
                    window.onload = function() {
                        var now = new Date();
                        var hours = now.getHours().toString().padStart(2, '0');
                        var minutes = now.getMinutes().toString().padStart(2, '0');
                        document.getElementById('jam').value = hours + ':' + minutes;
                    };
                </script>

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <div class="input-group">
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                        <button class="btn btn-primary d-flex align-items-center" type="button" id="captureBtn">
                            <i class="fa fa-camera me-2"></i> Ambil Kamera
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
                    document.getElementById('captureBtn').addEventListener('click', function() {
                        let video = document.getElementById('video');
                        let takePhotoBtn = document.getElementById('takePhotoBtn');

                        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                            navigator.mediaDevices.getUserMedia({ video: true })
                                .then(function(stream) {
                                    video.srcObject = stream;
                                    video.style.display = "block";
                                    takePhotoBtn.style.display = "block";
                                })
                                .catch(function(error) {
                                    alert("Kamera tidak bisa diakses: " + error);
                                });
                        } else {
                            alert("Browser tidak mendukung akses kamera");
                        }
                    });

                    document.getElementById('takePhotoBtn').addEventListener('click', function() {
                        let video = document.getElementById('video');
                        let canvas = document.getElementById('canvas');
                        let context = canvas.getContext('2d');

                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);

                        canvas.toBlob(function(blob) {
                            let file = new File([blob], "captured-image.jpg", { type: "image/jpeg" });
                            let dataTransfer = new DataTransfer();
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
