<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/_sdk/element_sdk.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>@yield('title')</title>
    <style>
        body {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Arial';
            background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%);
            height: 100%;
            min-height: 100%;
        }

        html {
            height: 100%;
        }

        .admin-container {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        .header {
            background: #ffffff;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 50;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
        }

        .user-menu {
            position: relative;
        }

        .user-button {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            background: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            cursor: pointer;
            font-size: 0.875rem;
            color: #4b5563;
        }

        .user-button:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1e3a8a, #0f172a);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .dropdown-arrow {
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 4px solid #9ca3af;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            min-width: 200px;
            display: none;
            z-index: 51;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #4b5563;
            text-decoration: none;
            border-bottom: 1px solid #f9fafb;
            font-size: 0.875rem;
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background: #f9fafb;
            color: #1f2937;
        }

        .dropdown-item:first-child {
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .dropdown-item:last-child {
            border-radius: 0 0 0.5rem 0.5rem;
        }

        .dropdown-icon {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        .dropdown-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: transparent;
            z-index: 40;
            display: none;
        }

        .dropdown-overlay.show {
            display: block;
        }

        /* Top Navigation Dropdown */
        .top-nav {
            display: flex;
            gap: 1rem;
        }

        .nav-dropdown {
            position: relative;
        }

        .nav-dropdown-btn {
            padding: 0.5rem 1rem;
            background: transparent;
            border: none;
            color: #4b5563;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            border-radius: 0.375rem;
        }

        .nav-dropdown-btn:hover {
            background: #f9fafb;
            color: #1e3a8a;
        }

        .nav-dropdown-content {
            position: absolute;
            top: 100%;
            left: 0;
            margin-top: 0.5rem;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            min-width: 160px;
            display: none;
            z-index: 52;
        }

        .nav-dropdown:hover .nav-dropdown-content {
            display: block;
        }

        .nav-dropdown-content a {
            display: block;
            padding: 0.75rem 1rem;
            color: #4b5563;
            text-decoration: none;
            font-size: 0.875rem;
            border-bottom: 1px solid #f9fafb;
        }

        .nav-dropdown-content a:last-child {
            border-bottom: none;
        }

        .nav-dropdown-content a:hover {
            background: #f9fafb;
            color: #1e3a8a;
        }

        .nav-dropdown-content a:first-child {
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .nav-dropdown-content a:last-child {
            border-radius: 0 0 0.5rem 0.5rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 1rem;
        }

        .content-area {
            width: 100%;
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .content-header {
            margin-bottom: 2rem;
        }

        .content-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
        }

        .content-subtitle {
            color: #6b7280;
            font-size: 1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .stat-card {
            position: relative;
            /* penting untuk anak posisikan absolute */
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .stat-card .icon {
            position: absolute;
            top: 15px;
            /* jarak dari atas kad */
            right: 15px;
            /* jarak dari kanan kad */
            font-size: 28px;
            /* boleh adjust ikut suka */
        }


        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .stat-label {
            color: #718096;
            font-size: 14px;
            font-weight: 500;
        }

        .stat-change {
            font-size: 12px;
            font-weight: 600;
            margin-top: 8px;
        }

        .positive {
            color: #38a169;
        }

        .negative {
            color: #e53e3e;
        }

        .filter-section {
            margin-top: 1.5rem;
        }

        .filter-dropdown {
            padding: 0.5rem 1rem;
            background: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            color: #4b5563;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            min-width: 150px;
        }

        .filter-dropdown:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
        }

        .filter-dropdown:focus {
            outline: none;
            border-color: #1e3a8a;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        .card-grid-two {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .card-two {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .card-title {
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .card-subtitle {
            color: #718096;
            font-size: 14px;
            font-weight: 500;
        }

        .card-two:hover {
            transform: translateY(-2px);
        }
    </style>
    <style>
        @view-transition {
            navigation: auto;
        }
    </style>
    <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
    <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
    <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
</head>

<body>
    <div class="admin-container">
        <header class="header">
            <div class="flex items-center text-lg font-semibold text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 3v18h18M9 13v5m4-8v8m4-11v11" />
                </svg>
                <span>Dashboard Data SPACE</span>
            </div>

            <div class="user-menu"><button class="user-button" id="user-button">
                    <span>{{ Auth::user()->name }}</span>
                    <div class="dropdown-arrow"></div>
                </button>
                <div class="dropdown-menu" id="dropdown-menu">

                    <a href="{{ route('change-password') }}" class="dropdown-item">
                        Change Password
                    </a>

                    <a href="#" class="dropdown-item">
                        Settings
                    </a>

                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="dropdown-item">

                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>

                </div>
            </div>
            <div class="dropdown-overlay" id="dropdown-overlay"></div>
        </header>


        <main class="main-content">
            <!-- <aside class="sidebar">
                <nav>
                    <ul class="nav-menu">
                        <li class="nav-item">
                            <a href="{{ route('tinjauan-akademik') }}" class="nav-link">
                                Ringkasan Eksekutif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kemasukan-pelajar') }}" class="nav-link">
                                Kemasukan Pelajar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Status Pengajian
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Prestasi Akademik
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Unjuran vs Kemasukan Sebenar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Kadar Tamat Pengajian
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Amaran Awal Prestasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Pengunaan Ruang Kuliah
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Data Alumni
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Jaminan Kualiti & Akreditasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Laporan Strategik Keseluruhan
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside> -->
            @yield('content')
        </main>
    </div>
    <script>
        // Dropdown functionality only
        const userButton = document.getElementById('user-button');
        const dropdownMenu = document.getElementById('dropdown-menu');
        const dropdownOverlay = document.getElementById('dropdown-overlay');

        function toggleDropdown() {
            const isOpen = dropdownMenu.classList.contains('show');

            if (isOpen) {
                closeDropdown();
            } else {
                openDropdown();
            }
        }

        function openDropdown() {
            dropdownMenu.classList.add('show');
            dropdownOverlay.classList.add('show');
        }

        function closeDropdown() {
            dropdownMenu.classList.remove('show');
            dropdownOverlay.classList.remove('show');
        }

        // Event listeners for dropdown
        userButton.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleDropdown();
        });

        dropdownOverlay.addEventListener('click', closeDropdown);

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                closeDropdown();
            }
        });
    </script>
    @stack('scripts')

</html>