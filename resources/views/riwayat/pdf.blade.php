<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Maitenance</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .cover-page { position: relative; width: 100%; height: 100vh; text-align: center; }
        .cover-page img { width: 100%; height: 100vh; object-fit: cover; }
        .cover-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
        }
        .logo-container {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 20px;
        }
        .logo-container img {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }
        .page-break { page-break-after: always; }
        .dokumentasi-container {
            display: flex;
            justify-content: space-around; 
            align-items: center; 
            gap: 40px; 
            margin-top: 10px;
        }

        .gambar-wrapper {
            width: 45%; 
            text-align: center;
        }

        .gambar-wrapper img {
            width: 100%; 
            height: auto;
            max-height: 200px; 
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 5px;
        }

        .gambar-wrapper p {
            margin-bottom: 5px; 
            font-weight: bold;
        }
        th {
            background-color: #485cbc;
            color: white;
        }
    </style>
</head>
<body>


<div class="cover-page">
    <img src="{{ public_path('storage/post-images/template.png') }}" alt="Cover">

    <div class="logo-container">
        @if(auth()->user()->role == 'admin')
            <img src="{{ public_path('assets/img/illustrations/helpme3.png') }}" alt="Logo Admin">
        @else
            @if($cover->logo_instansi)
                <img src="{{ public_path('storage/' . $cover->logo_instansi) }}" alt="Logo Instansi">
            @endif

            @if($cover->logo_umum)
                <img src="{{ public_path('storage/' . $cover->logo_umum) }}" alt="Logo Umum">
            @endif
        @endif
    </div>

    <div class="cover-content">
        @if(auth()->user()->role == 'admin')
            <h1 style="font-size: 36px; font-weight: bold;">Laporan Riwayat User</h1>
        @elseif($cover)
            <h1 style="font-size: 36px; font-weight: bold;">{{ $cover->judul }}</h1>
        @endif
        <p style="text-align: center; font-size: 18px; font-weight: bold; margin-bottom: 20px;">
        {{ \Carbon\Carbon::parse($filter_tanggal_mulai)->locale('id')->translatedFormat('d F Y') }} - 
        {{ \Carbon\Carbon::parse($filter_tanggal_selesai)->locale('id')->translatedFormat('d F Y') }}
    </p>
    </div>
</div>
 <div class="page-break"></div>
<h2 style="text-align: center; font-size: 22px; font-weight: bold;">RIWAYAT PERBAIKAN</h2>
    <table border="1" cellspacing="0" cellpadding="8" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Klien</th>
                <th>Keluhan</th>
                <th>Deskripsi Perbaikan</th>
                <th>Tanggal Keluhan</th>
                <th>Tanggal Perbaikan</th>
                <th>Durasi Perbaikan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riwayat as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->klien }}</td>
                    <td>{{ $item->keluhan }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>{{ $item->tgl_keluhan }}</td>
                    <td>{{ $item->tgl_perbaikan }}</td>
                    <td>{{ $item->durasi_perbaikan }}</td>
                </tr>
                <tr>
                <td colspan="7" style="text-align: center; padding: 15px;">
                    <strong>DOKUMENTASI</strong>
                    <table width="100%" style="margin-top: 10px; border-collapse: collapse;">
                        <tr>
                            <td style="text-align: center; width: 50%;">
                                <p><strong>Sebelum Perbaikan</strong></p>
                                <img src="{{ public_path('storage/' . $item->gambar) }}" 
                                    alt="Sebelum Perbaikan" 
                                    style="width: 50%; max-height: 80px; border: 1px solid #ddd; padding: 5px;">
                            </td>
                            <td style="text-align: center; width: 50%;">
                                <p><strong>Setelah Perbaikan</strong></p>
                                <img src="{{ public_path('storage/' . $item->gambar_perbaikan) }}" 
                                    alt="Setelah Perbaikan" 
                                    style="width: 50%; max-height: 80px; border: 1px solid #ddd; padding: 5px;">
                            </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
