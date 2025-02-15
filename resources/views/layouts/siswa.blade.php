<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa Dashboard - SMK Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            background-color: #343a40;
            width: 250px;
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #fff;
            padding: 15px 25px;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
        }

        .sidebar .nav-link.active {
            background-color: rgba(255,255,255,0.2);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .top-navbar {
            position: fixed;
            top: 0;
            right: 0;
            left: 250px;
            z-index: 99;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-wrapper {
            margin-top: 70px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-sticky">
            <div class="text-center mb-4">
                <h4 class="text-white">Siswa Panel</h4>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('siswa/dashboard') ? 'active' : '' }}"
                       href="{{ route('siswa.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('siswa/nilai*') ? 'active' : '' }}"
                       href="{{ route('siswa.nilai') }}">
                        <i class="fas fa-star"></i>
                        Nilai
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('siswa/gallery*') ? 'active' : '' }}"
                       href="{{ route('siswa.gallery') }}">
                        <i class="fas fa-images"></i>
                        Galeri
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link border-0 bg-transparent">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Top Navbar -->
    <nav class="top-navbar">
        <div>
            <h5 class="mb-0">{{ auth()->user()->name }}</h5>
            <small class="text-muted">Siswa - Kelas {{ auth()->user()->siswa->kelas }}</small>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-wrapper">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
