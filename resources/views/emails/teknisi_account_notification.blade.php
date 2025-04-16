<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Teknisi Baru</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 15px;
        }
        h2 {
            color: #2c3e50;
            margin-top: 0;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .content {
            margin-bottom: 25px;
        }
        .credentials {
            background-color: #f8f9fa;
            border-left: 4px solid #3498db;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .credentials p {
            margin: 5px 0;
        }
        .btn {
            display: inline-block;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 4px;
            margin: 15px 0;
            text-align: center;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            text-align: center;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
        </div>
        
        <h2>Halo {{ $data['name'] }},</h2>
        
        <div class="content">
            <p>Selamat! Akun teknisi Anda telah berhasil dibuat. Berikut adalah informasi login Anda:</p>
            
            <div class="credentials">
                <p><strong>Email:</strong> {{ $data['email'] }}</p>
                <p><strong>Password:</strong> {{ $data['password'] }}</p>
            </div>
            
            <p>Silakan login ke sistem dengan link berikut:</p>
            <a href="{{ $loginUrl }}">{{ $loginUrl }}</a>
            <p>Terima kasih!</p>
        
    </div>
</body>
</html>