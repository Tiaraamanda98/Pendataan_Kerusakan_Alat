@extends('layouts.app')
@section('content')
<br>
<br>
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-0 text-center">DAFTAR KELUHAN SELESAI</h3>
            <br>
            <br>
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center" style="width: 100%;">
                    <thead style="background-color: #485cbc; color: white;">
            <tr>
                <th>No</th>
                <th>Klien</th>
                <th>Keluhan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduanSelesai as $index => $pengaduan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pengaduan->klien }}</td>
                <td>{{ $pengaduan->keluhan }}</td>
                <td>{{ $pengaduan->tgl_keluhan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>
</div>
@endsection
