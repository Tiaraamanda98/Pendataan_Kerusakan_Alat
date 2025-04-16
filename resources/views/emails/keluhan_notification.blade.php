<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Keluhan Baru</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #f6f9fc; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); overflow: hidden;">
   
        <div style="background-color: #3a66db; padding: 25px 20px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 24px;">🔧 Notifikasi Keluhan Baru</h1>
        </div>
        
        <div style="padding: 30px 25px;">
            <p style="color: #5e6977; font-size: 16px; margin-top: 0; margin-bottom: 25px; text-align: center;">
                Keluhan baru telah masuk ke dalam sistem dan memerlukan tindak lanjut
            </p>
            
            <div style="background-color: #f8fafd; border-left: 4px solid #3a66db; padding: 15px; margin-bottom: 25px; border-radius: 4px;">
                <h3 style="color: #3a66db; margin-top: 0; margin-bottom: 15px; font-size: 18px;">Detail Keluhan:</h3>
                
                <table style="width: 100%; border-collapse: collapse;">

                    <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; width: 30%;"><strong style="color: #4a5568;">Instansi:</strong></td>
                        <td style="padding: 8px 0; color: #2d3748;">{{ $data['nama_instansi'] }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong style="color: #4a5568;">Pelapor:</strong></td>
                        <td style="padding: 8px 0; color: #2d3748;">{{ $data['nama_pelapor'] }}</td>
                    </tr>
        
                    <tr>
                        <td style="padding: 8px 0;"><strong style="color: #4a5568;">Unit:</strong></td>
                        <td style="padding: 8px 0; color: #2d3748;">{{ $data['unit'] }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong style="color: #4a5568;">Keluhan:</strong></td>
                        <td style="padding: 8px 0; color: #e53e3e; font-weight: 600;">{{ $data['keluhan'] }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong style="color: #4a5568;">Deskripsi:</strong></td>
                        <td style="padding: 8px 0; color: #2d3748;">{{ $data['deskripsi'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong style="color: #4a5568;">Tanggal:</strong></td>
                        <td style="padding: 8px 0; color: #2d3748;">{{ $data['tgl_keluhan'] }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong style="color: #4a5568;">Jam:</strong></td>
                        <td style="padding: 8px 0; color: #2d3748;">{{ $data['jam'] ?? '-' }}</td>
                    </tr>
                </table>
            </div>
            
            @if (!empty($data['gambar']))
                <div style="text-align: center; margin-bottom: 25px;">
                    <h3 style="color: #4a5568; margin-bottom: 12px;">Gambar Kerusakan</h3>
                    <img src="{{ asset('storage/' . $data['gambar']) }}" 
                         alt="Gambar Kerusakan" 
                         style="max-width: 100%; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
                </div>
            @else
                <div style="background-color: #f8f9fa; padding: 15px; text-align: center; border-radius: 6px; margin-bottom: 25px;">
                    <p style="color: #718096; margin: 0;"><i>Tidak ada gambar kerusakan yang dilampirkan</i></p>
                </div>
            @endif
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('teknisi.login.form') }}" 
                   style="display: inline-block; background-color: #3a66db; color: #ffffff; font-weight: bold; padding: 12px 30px; text-decoration: none; border-radius: 6px; box-shadow: 0 2px 5px rgba(58, 102, 219, 0.3); transition: all 0.3s ease;">
                   🔐 Tindak Lanjuti Keluhan
                </a>
                
                <p style="color: #718096; margin-top: 15px; font-size: 14px;">
                    Anda akan diarahkan ke halaman login teknisi terlebih dahulu
                </p>
            </div>
        </div>
        
    </div>
</body>
</html>