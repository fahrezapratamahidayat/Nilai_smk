<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smk Indonesia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #ffe4f2;
        }
        .navbar {
            background: #fff;
        }
        .hero {
            text-align: center;
            padding: 80px 20px;
            background: #ffe4f2;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #ADD8E6;
        }
        .hero p {
            color: #c679c4;
        }
        .btn-custom {
            background: #d27fde;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
        }
        .btn-custom:hover {
            background: #c679c4;
        }

        /* Tambahan style untuk galeri */
        .gallery-section {
            background: #fff;
            padding: 60px 0;
        }
        .gallery-title {
            text-align: center;
            margin-bottom: 40px;
            color: #d27fde;
        }
        .gallery-card {
            margin-bottom: 30px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .gallery-card:hover {
            transform: translateY(-5px);
        }
        .gallery-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .gallery-card .card-body {
            padding: 15px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">SMK Indonesia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-danger" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="siswa">Siswa</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="#">Guru</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="nilai_siswa">Nilai</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="#">Contact</a></li>
                </ul>
                <a href="login" class="btn btn-warning ms-3">Login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Selamat Datang<br>Di Website</h1>
        <p>Nilai Siswa SMK Indonesia</p>
        <a href="#gallery" class="btn btn-custom">Lihat Galeri</a>
    </div>

    <!-- Gallery Section -->
    <section id="gallery" class="gallery-section">
        <div class="container">
            <h2 class="gallery-title">Galeri Kegiatan</h2>
            <div class="row">
                @forelse($galleries as $gallery)
                <div class="col-md-4">
                    <div class="card gallery-card">
                        <img src="{{ asset('storage/gallery/' . $gallery->image) }}"
                             class="gallery-img"
                             alt="{{ $gallery->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $gallery->title }}</h5>
                            <p class="card-text text-muted">{{ $gallery->description }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>Belum ada foto di galeri</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center mt-5 p-3 bg-light">
        &copy; 2024 SMK Indonesia. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
