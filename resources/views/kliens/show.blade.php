@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow border-0" id="laporan-print">
        <div class="card-header laporan-header">
            <h4 class="mb-0 text-white">
                <i class="bi bi-file-earmark-text"></i> LAPORAN PERBAIKAN KELUHAN
            </h4>
        </div>

        <div class="card-body px-4 py-3">
            <table class="table laporan-table">
                <tbody>
                    <tr>
                        <td><strong>ID Tiket</strong></td>
                        <td>#{{ $klien->id_tiket }}</td>
                    </tr>
                    <tr>
                        <td><strong>Keluhan</strong></td>
                        <td>{{ $klien->keluhan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Klien</strong></td>
                        <td>{{ $klien->klien }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama User</strong></td>
                        <td>{{ $klien->nama_pelapor }}</td>
                    </tr>
                    <tr>
                        <td><strong>Unit</strong></td>
                        <td>{{ $klien->unit }}</td>
                    </tr>
                    <tr>
                        <td><strong>Deskripsi</strong></td>
                        <td>{{ $klien->deskripsi }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Keluhan</strong></td>
                        <td>{{ $klien->tgl_keluhan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jam</strong></td>
                        <td>{{ $klien->jam }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>
                            <span class="badge {{ $klien->status == 'Menunggu' ? 'bg-warning text-dark' : 'bg-success text-white' }}">
                                {{ $klien->status }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Teknisi</strong></td>
                        <td>{{ optional($klien->teknisi)->name ?? '-' }}</td>
                    </tr>

                </tbody>
            </table>

            <h5 class="fw-bold text-dark mt-4">Detail Perbaikan</h5>
            <table class="table laporan-table">
                <tbody>
                    <tr>
                        <td><strong>Deskripsi Perbaikan</strong></td>
                        <td>{{ $klien->deskripsi_perbaikan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Perbaikan</strong></td>
                        <td>{{ $klien->tgl_perbaikan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Durasi Perbaikan</strong></td>
                        <td>{{ $klien->durasi_perbaikan ?? '-' }}</td>
                    </tr>
                                                 
                </tbody>
            </table>
                 
            <h5 class="fw-bold text-dark mt-4">Dokumentasi</h5>
            <div class="d-flex justify-content-center gap-4 flex-wrap">
                <div class="text-center">
                    <p><strong>Gambar Sebelum Perbaikan</strong></p>
                    @if($klien->gambar)
                        <img src="{{ asset('storage/' . $klien->gambar) }}" alt="Gambar Sebelum" class="img-thumbnail shadow-sm" width="180">
                    @else
                        <p class="text-muted">Tidak ada</p>
                    @endif
                </div>
                <div class="text-center">
                    <p><strong>Gambar Setelah Perbaikan</strong></p>
                    @if($klien->gambar_perbaikan)
                        <img src="{{ asset('storage/' . $klien->gambar_perbaikan) }}" alt="Gambar Sesudah" class="img-thumbnail shadow-sm" width="180">
                    @else
                        <p class="text-muted">Tidak ada</p>
                    @endif
                </div>
            </div>       
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


<div class="d-flex justify-content-center gap-2 mt-4 no-print">
    <button onclick="downloadPDF();" class="btn btn-primary btn-sm">
        <i class="bi bi-printer"></i> Cetak Laporan
    </button>
    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">
        Kembali ke Dashboard
    </a>
</div>

<script>
    function downloadPDF() {
        const { jsPDF } = window.jspdf;
        const laporan = document.getElementById("laporan-print");

        html2canvas(laporan, { scale: 3 }).then(canvas => {
            const imgData = canvas.toDataURL("image/png");

            const pdf = new jsPDF("l", "mm", "a4");

            const imgWidth = 297;
            const pageHeight = 210;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;

            pdf.addImage(imgData, "PNG", 0, 10, imgWidth, Math.min(imgHeight, pageHeight - 20), undefined, "FAST");

            pdf.save("Laporan_Keluhan.pdf");
        });
    }
</script>

<a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">
    Kembali ke Dashboard
</a>

<style>
.laporan-header {
    background-color: #485cbc !important;
    color: white;
    text-align: center;
    padding: 15px;
    border-radius: 5px 5px 0 0;
}
.laporan-table {
    width: 100%;
    table-layout: fixed;
    border-collapse: collapse;
    font-size: 10pt; 
}

.laporan-table th {
    background-color: #f8f9fa;
    font-weight: 500; 
    padding: 6px;
}

.laporan-table td {
    padding: 6px;
    border: 1px solid #ddd;
    word-wrap: break-word;
}

@media print {
    body * {
        visibility: hidden;
    }

    #laporan-print, #laporan-print * {
        visibility: visible;
    }

    .no-print {
        display: none !important;
    }

    #laporan-print {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

    @page {
        size: A4 landscape;
        margin: 10mm;
    }

    .laporan-table {
        width: 100%;
        font-size: 9pt;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .laporan-table td, .laporan-table th {
        padding: 4px;
        border: 1px solid #bbb; 
        vertical-align: top;
        word-wrap: break-word;
    }
}
</style>
@endsection
