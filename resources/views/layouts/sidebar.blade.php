<div id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="{{ route('dashboard') }}" class="sidebar-link">
                    <img src="{{ asset('assets/images/logo/helpme4.png') }}" alt="Logo" style="width: 200px; height: auto;">
                </a>
            </div>
            <div class="toggler">
                <!-- This is the X button that closes the sidebar on mobile -->
                <span class="sidebar-hide d-lg-none">&times;</span>
                <!-- This is the hamburger inside the sidebar that shows on mobile -->
                <span class="responsive-toggle d-lg-none">&#9776;</span>
            </div>
        </div>
    </div>

    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="sidebar-link">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-title">Forms &amp; Tables</li>
            @if(Auth::check() && Auth::user()->role === 'admin')
            <li class="sidebar-item">
                <a href="{{ route('users.index') }}" class="sidebar-link">
                    <i class="bi bi-person-fill"></i>
                    <span>User</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('kliens.index') }}" class="sidebar-link">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Keluhan</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('covers.index') }}" class="sidebar-link">
                    <i class="bi bi-journal-bookmark-fill"></i> 
                    <span>Cover</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('kliens.riwayat') }}" class="sidebar-link">
                    <i class="bi bi-download"></i>
                    <span>Riwayat</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('teknisis.index') }}" class="sidebar-link">
                    <i class="bi bi-person-fill"></i>
                    <span>Teknisi</span>
                </a>
            </li>

            @elseif(Auth::check() && Auth::user()->role === 'teknisi')
                <li class="sidebar-item">
                    <a href="{{ route('kliens.index') }}" class="sidebar-link">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Keluhan</span>
                    </a>
                </li>

            @elseif(Auth::check() && Auth::user()->role === 'user')
            <li class="sidebar-item">
                <a href="{{ route('teknisis.index') }}" class="sidebar-link">
                <i class="bi bi-person-fill"></i>
                    <span>Teknisi</span>
                </a>
            </li>

                <li class="sidebar-item">
                    <a href="{{ route('kliens.index') }}" class="sidebar-link">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Keluhan</span>
                    </a>
                </li>

            <li class="sidebar-item">
                <a href="{{ route('covers.index') }}" class="sidebar-link">
                    <i class="bi bi-journal-bookmark-fill"></i> 
                    <span>Cover</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('kliens.riwayat') }}" class="sidebar-link">
                    <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                    <span>Riwayat</span>
                </a>
            </li>

        @endif

            </ul> 
        </div>
    </div>
    
    <!-- Outside hamburger to open sidebar (only on mobile) -->
    <div class="outside-toggler">
        <span class="sidebar-toggle d-lg-none">&#9776;</span> 
    </div>

<div class="sidebar-overlay"></div>

<style>
.sidebar-wrapper {
    width: 250px;
    height: 100vh;
    background-color: #343a40;
    color: white;
    position: fixed;
    top: 0;
    left: -250px;
    transition: all 0.3s ease-in-out;
    overflow-y: auto;
    z-index: 1000;
}
.sidebar-wrapper.active {
    left: 0;
}
.sidebar-toggle {
    font-size: 24px;
    color: white;
    cursor: pointer;
    display: block;
    padding: 10px;
    z-index: 1100;
    position: fixed;
    top: 15px;
    left: 15px;
    background-color: #343a40;
    padding: 8px 12px;
    border-radius: 4px;
}
.sidebar-hide {
    font-size: 24px;
    color: white;
    cursor: pointer;
    display: none;
    padding: 10px;
}
.responsive-toggle {
    font-size: 24px;
    color: white;
    cursor: pointer;
    padding: 10px;
    display: block;
}
.sidebar-wrapper.active .sidebar-hide {
    display: block;
}
.sidebar-wrapper.active + .outside-toggler .sidebar-toggle {
    display: none;
}
.sidebar-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    visibility: hidden;
    opacity: 0;
    transition: all 0.3s ease-in-out;
    z-index: 998;
}

.sidebar-wrapper.active + .sidebar-overlay {
    visibility: visible;
    opacity: 1;
}

@media (min-width: 992px) {
    .sidebar-wrapper {
        left: 0;
    }

    .sidebar-toggle {
        display: none;
    }

    .sidebar-hide {
        display: none !important;
    }
    
    .responsive-toggle {
        display: none !important;
    }

    .sidebar-overlay {
        display: none;
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.querySelector(".sidebar-wrapper");
    const toggleButtons = document.querySelectorAll(".sidebar-toggle");
    const closeButton = document.querySelector(".sidebar-hide"); 
    const responsiveToggle = document.querySelector(".responsive-toggle");
    const overlay = document.querySelector(".sidebar-overlay");

    function openSidebar() {
        sidebar.classList.add("active");
        overlay.style.visibility = "visible";
        overlay.style.opacity = "1";
    }
    
    function closeSidebar() {
        if (window.innerWidth < 992) { // Only close on mobile
            sidebar.classList.remove("active");
            overlay.style.visibility = "hidden";
            overlay.style.opacity = "0";
        }
    }
    
    // Open sidebar button
    toggleButtons.forEach(button => button.addEventListener("click", openSidebar));
    
    // Close sidebar buttons
    closeButton.addEventListener("click", closeSidebar);
    responsiveToggle.addEventListener("click", closeSidebar);
    
    // Close when clicking overlay
    overlay.addEventListener("click", closeSidebar);
    
    // Handle responsive behavior
    function handleResponsive() {
        if (window.innerWidth >= 992) {
            // Desktop: Always show sidebar
            sidebar.classList.add("active");
        } else {
            // Mobile: Initially hide sidebar
            sidebar.classList.remove("active");
            overlay.style.visibility = "hidden";
            overlay.style.opacity = "0";
        }
    }
    
    // Initialize on page load
    handleResponsive();
    
    // Handle window resize
    window.addEventListener("resize", handleResponsive);
});
</script>