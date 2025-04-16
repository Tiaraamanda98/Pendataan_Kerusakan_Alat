<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pendataan Kerusakan Alat</title>

  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/helpme4.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/helpme4.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/helpme4.png">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
  <link rel="manifest" href="assets/img/favicons/manifest.json">
  <meta name="msapplication-TileImage" content="assets/img/favicons/helpme4.png">
  <meta name="theme-color" content="#ffffff">

  <link href="vendors/plyr/plyr.css" rel="stylesheet">
  <link href="assets/css/theme.css" rel="stylesheet" />
  
  <style>
    :root {
      --primary-color: #485cbc;
      --secondary-color: #37449a;
      --accent-color: #f3f4ff;
      --text-color: #333;
      --light-text: #666;
    }
    
    body {
      font-family: 'Nunito Sans', sans-serif;
      color: var(--text-color);
    }
    
    .hero-section {
      min-height: 100vh;
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden;
      background: linear-gradient(to right, #fff, #f8f9ff);
    }
    
    .hero-content {
      padding: 2rem;
      z-index: 10;
    }
    
    .navbar {
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
      background-color: rgba(255, 255, 255, 0.95);
      padding: 0.8rem 2rem;
    }
    
    .navbar-brand img {
      height: 40px;
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      padding: 0.8rem 1.5rem;
      border-radius: 30px;
      font-weight: 600;
      transition: all 0.3s ease;
      margin: 0.5rem;
    }
    
    .btn-primary:hover {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
      transform: translateY(-3px);
      box-shadow: 0 4px 15px rgba(72, 92, 188, 0.3);
    }
    
    .display-1 {
      font-weight: 800;
      margin-bottom: 1rem;
      color: var(--primary-color);
    }
    
    .hero-text {
      font-size: 1.2rem;
      line-height: 1.6;
      color: var(--light-text);
      margin-bottom: 2rem;
    }
    
    .feature-box {
      background: white;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
      margin-bottom: 1.5rem;
      transition: all 0.3s ease;
    }
    
    .feature-box:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .feature-icon {
      background-color: var(--accent-color);
      width: 60px;
      height: 60px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1rem;
    }
    
    .bg-shape {
      position: absolute;
      z-index: 0;
    }
    
    .actions-container {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      margin-top: 2rem;
    }
    
    @media (max-width: 768px) {
      .display-1 {
        font-size: 2.5rem;
      }
      
      .actions-container {
        justify-content: center;
      }
      
      .hero-section {
        text-align: center;
      }
    }
  </style>
</head>

<body>
  <main class="main" id="top">
    <nav class="navbar navbar-expand-lg fixed-top py-3">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="assets/img/favicons/helpme4.png" alt="Logo" />
          <span class="ms-2 fw-bold" style="color: var(--primary-color);">HELP ME</span>
        </a>
      </div>
    </nav>

    <section class="hero-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 hero-content">
            <h1 class="display-1">Pendataan Kerusakan Alat</h1>
            <p class="hero-text"> Solusi lengkap untuk mengelola dan melacak kerusakan alat Anda. Dapatkan laporan real-time, tingkatkan efisiensi perbaikan, dan pastikan setiap masalah tertangani tepat waktu.</p>
            
            <div class="actions-container">
              <a class="btn btn-primary" href="{{ route('register') }}" role="button">
                <i class="fas fa-user me-2"></i>Register
              </a>
              <a class="btn btn-primary" href="{{ route('login') }}" role="button">
              <i class="fas fa-user me-2"></i></i>Login
              </a>
            </div>
          </div>
          
          <div class="col-lg-6 d-none d-lg-block">
            <img src="assets/img/illustrations/helpme3.png" alt="Hero Illustration" class="img-fluid" />
          </div>
        </div>
      </div>
    </section>

<section class="py-5" style="background-color: #f8f9ff;">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold" style="color: var(--primary-color);">Fitur Unggulan</h2>
      <p class="text-muted">Dapatkan pengalaman terbaik menggunakan aplikasi kami</p>
    </div>
    
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="feature-box text-center">
          <div class="feature-icon mx-auto">
            <i class="fas fa-clipboard-list" style="color: var(--primary-color); font-size: 24px;"></i>
          </div>
          <h4>Pendataan Cepat</h4>
          <p>Laporkan kerusakan dengan cepat dan mudah melalui form yang sederhana</p>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="feature-box text-center">
          <div class="feature-icon mx-auto">
            <i class="fas fa-search" style="color: var(--primary-color); font-size: 24px;"></i>
          </div>
          <h4>Pelacakan Status</h4>
          <p>Pantau status perbaikan alat Anda secara real-time</p>
        </div>
      </div>
    </div>
  </div>
</section>

    </section>
    
    <footer class="py-4 bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mb-3">
            <img src="assets/img/favicons/helpme4.png" alt="Logo" width="40" />
            <span class="ms-2 fw-bold">HELP ME</span>
            <p class="small mt-2">Aplikasi Pendataan Kerusakan Alat menyediakan solusi efisien untuk melaporkan dan menangani kerusakan alat dengan cepat.</p>
          </div>
          
        <div class="text-center pt-3 border-top border-secondary">
          <p class="small text-white-50">&copy; HELP ME - Pendataan Kerusakan Alat</p>
        </div>
      </div>
    </footer>
  </main>

  <script src="vendors/@popperjs/popper.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.min.js"></script>
  <script src="vendors/is/is.min.js"></script>
  <script src="vendors/plyr/plyr.polyfilled.min.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="assets/js/theme.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
</body>
</html>