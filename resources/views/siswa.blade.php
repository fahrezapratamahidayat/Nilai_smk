<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background-color: #f4f4f4;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #eab9ff;">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Data Siswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-danger" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="siswa">siswa</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="#">guru</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="nilai_siswa">nilai</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="#">admin</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="#">Contact</a></li>
                </ul>
                <a href="login"class="btn btn-warning ms-3">Login</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5">
        <h2 class="fw-bold text-center">Data Siswa</h2>

        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped bg-white">
                <thead class="table-success">
                    <tr>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>123456</td>
                        <td>Ahmad Fauzi</td>
                        <td>Laki-laki</td>
                        <td>12 Januari 2005</td>
                        <td>Bandung</td>
                        <td><img src="https://via.placeholder.com/60" width="60" alt="Foto"></td>
                    </tr>
                    <tr>
                        <td>789012</td>
                        <td>Siti Aisyah</td>
                        <td>Perempuan</td>
                        <td>5 Maret 2006</td>
                        <td>Jakarta</td>
                        <td><img src="https://via.placeholder.com/60" width="60" alt="Foto"></td>
                    </tr>
                    <tr>
                        <td>345678</td>
                        <td>Rizky Ramadhan</td>
                        <td>Laki-laki</td>
                        <td>25 Mei 2005</td>
                        <td>Surabaya</td>
                        <td><img src="https://via.placeholder.com/60" width="60" alt="Foto"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3 mt-5" style="background-color: #eab9ff; color: white;">
        <p>&copy; 2024 Smk indonesia| All Rights Reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>