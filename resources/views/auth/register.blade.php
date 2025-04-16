<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
    background: #f8fbff;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

.container-box {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 450px;
    padding: 40px;
}

.right-panel {
    width: 100%;
}

.form-label {
    font-weight: bold;
    display: block;
    text-align: left;
}

.form-control {
    border-radius: 8px;
    padding: 12px;
    border: 1px solid #ccc;
    background: #f8fbff;
    transition: 0.3s;
}

.form-control:focus {
    border-color: #485cbc;
    box-shadow: 0 0 5px rgba(72, 92, 188, 0.5);
    background: #ffffff;
}

.btn-primary {
    background: #485cbc;
    border: none;
    padding: 12px;
    border-radius: 8px;
    font-weight: bold;
    width: 100%;
    transition: 0.3s;
}

.btn-primary:hover {
    background: #3c4ca6;
    box-shadow: 0 3px 10px rgba(72, 92, 188, 0.3);
}

.small-text {
    font-size: 14px;
    text-align: center;
}


    </style>
</head>
<body>

    <div class="container-box">
        <div class="left-panel d-none d-md-flex">
            <img src="{{ asset('assets/images/logo/log.jpg') }}" alt="Illustrasi" class="img-fluid" style="width: 1000px; height: auto;">
        </div>

       
        <div class="right-panel">
            <h2 class="fw-bold text-center mb-4">Registrasi Pengguna</h2>
            <form action="{{ route('register.submit') }}" method="POST">
                @csrf

        <div class="mb-3">
           <label class="form-label fw-bold d-block">Nama Instansi</label>
            <input type="text" name="nama_instansi" id="nama_instansi" class="form-control" placeholder="Nama Instansi" required>
         </div>

                          
        <div class="mb-3">
            <label class="form-label fw-bold d-block">Email Instansi</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email Instansi" required>
        </div>


        <div class="mb-3 position-relative">
            <label class="form-label fw-bold d-block">Password</label>
            <div class="input-group">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            <button type="button" class="btn toggle-btn" onclick="togglePassword('password', 'togglePasswordIcon1')">
            <i id="togglePasswordIcon1" class="bi bi-eye"></i>
        </button>
    </div>
</div>


     <div class="mb-3 position-relative">
        <label class="form-label fw-bold d-block">Konfirmasi Password</label>
        <div class="input-group">
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
        <button type="button" class="btn toggle-btn" onclick="togglePassword('password_confirmation', 'togglePasswordIcon2')">
        <i id="togglePasswordIcon2" class="bi bi-eye"></i>
        </button>
    </div>
</div>


<script>
    function togglePassword(fieldId, iconId) {
        let passwordField = document.getElementById(fieldId);
        let icon = document.getElementById(iconId);

        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        } else {
            passwordField.type = "password";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        }
    }
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<style>
    .toggle-btn {
        background-color: #485cbc !important; 
        border: none; 
        color: white !important; 
        padding: 5px 12px; 
        border-radius: 5px; 
    }

    .toggle-btn:hover {
        background-color: #3c4ea2 !important; 
    }

    .toggle-btn i {
        font-size: 1.2rem; 
    }
</style>
          
<button type="submit" class="btn btn-primary w-100">Daftar</button>
</form>

    <p class="text-center mt-3">Sudah punya akun? 
        <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
    </p>
        </div>
    </div>
</body>
</html>
