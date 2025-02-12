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
            color: ##ADD8E6;
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
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">smk indonesia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-danger" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="siswa">siswa</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="#">guru</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="nilai_siswa">nilai</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="#">Contact</a></li>
                </ul>
                <a href="login"class="btn btn-warning ms-3">Login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Selamat Datang<br>Di Website </h1>
        <p>Nilai Siswa Smk Indonesia</p>
        <a href="#" class="btn btn-custom">Selengkapnya</a>
    </div>

    <!-- Produk -->
    <div class="container text-center mt-5">
        <img src="https://via.placeholder.com/500" class="img-fluid" alt="Produk Skincare">
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5 p-3 bg-light">
        &copy; 2024 smk indonesia. All rights reserved.
    </footer>

</body>
</html>
