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
            <a class="navbar-brand fw-bold" href="#">Nilai Siswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-danger" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="#">siswa</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="#">guru</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="#">nilai</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="#">admin</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="#">Contact</a></li>
                </ul>
                <a href="login"class="btn btn-warning ms-3">Login</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5">
        <h2 class="fw-bold text-center">Nilai Siswa</h2>

        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped bg-white">
                <thead class="table-success">
                    <tr>
                        <th>id nilai</th>
                        <th>nisn</th>
                        <th>nip</th>
                        <th>mata pelajaran</th>
                        <th>jenis ujian</th>
                        <th>nilai</th>
                        <th>grade</th>
                        <th>semester</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>12</td>
                        <td>11234</td>
                        <td>2202</td>
                        <td>bahasa indonesia</td>
                        <td>UAS</td>
                        <td>90</td>
                        <td>A</td>
                        <td>ganjil</td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>11233</td>
                        <td>2202</td>
                        <td>bahasa sunda</td>
                        <td>UAS</td>
                        <td>90</td>
                        <td>A</td>
                        <td>ganjil</td>
                    </tr>
                    </tr>
                    <tr>
                    <tr>
                        <td>13</td>
                        <td>11234</td>
                        <td>2202</td>
                        <td>matematika</td>
                        <td>UAS</td>
                        <td>90</td>
                        <td>A</td>
                        <td>ganjil</td>
                    </tr>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3 mt-5" style="background-color: #eab9ff; color: white;">
        <p>&copy; 2025 smk indonesia | All Rights Reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>