<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
</head>
<body>
<div class="container-box text-center">
   
    <img src="{{ asset('assets/images/logo/log.jpg') }}" alt="Illustrasi" class="img-fluid" style="width: 1000px; height: auto;">

        <div class="login-container">
            <h3 class="text-center fw-bold mb-4">Login</h3>

         
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
                </div>

                <div class="mb-3 position-relative">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        <button type="button" class="btn toggle-btn" onclick="togglePassword('password', 'togglePasswordIcon1')">
                            <i id="togglePasswordIcon1" class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-lg fw-bold">Login</button>
            </form>

            <p class="text-center mt-3">Belum punya akun? 
                <a href="{{ route('register') }}" class="text-decoration-none">Daftar</a>
            </p>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

 
   @if(session('success'))
    <script>
      Swal.fire({
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonColor: '#485cbc',
        confirmButtonText: 'OK'
      });
    </script>
  @endif

  @if ($errors->any())
    <script>
      Swal.fire({
        title: 'Terjadi Kesalahan!',
        html: `{!! implode('<br>', $errors->all()) !!}`,
        icon: 'error',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'OK'
      });
    </script>
  @endif


</body>
</html>
