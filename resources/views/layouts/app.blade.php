<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan Kerusakan Alat</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

   
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <style>
        #sidebar {
            width: 250px;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            background: #f8f9fa;
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 1100;
        }

        #sidebar.d-none {
            width: 0;
            overflow: hidden;
        }

        .navbar {
            width: 100%;
            max-width: 100%;
            z-index: 1050;
        }

        @media (max-width: 992px) {
            #sidebar {
                width: 250px;
                position: fixed;
                left: -250px;
                transition: all 0.3s;
            }

            #sidebar.active {
                left: 0;
            }

            .navbar {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 1050;
            }

            .content {
                margin-top: 56px;
            }
        }
    </style>
</head>
<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        @include('layouts.sidebar')
        <div class="body-wrapper">
            <header class="app-header">
                @include('layouts.navbar')
            </header>

            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleBtn = document.getElementById("sidebarToggle");
            const hideBtn = document.querySelector(".sidebar-hide");
            const sidebar = document.getElementById("sidebar");

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener("click", function () {
                    sidebar.classList.toggle("active");
                });
            }

            if (hideBtn && sidebar) {
                hideBtn.addEventListener("click", function () {
                    sidebar.classList.remove("active");
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
