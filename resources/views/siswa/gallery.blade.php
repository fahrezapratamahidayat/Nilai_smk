@extends('layouts.siswa')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Galeri Kegiatan Sekolah</h2>
        </div>

        <div class="row g-4">
            <!-- Kegiatan 1 -->
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Kegiatan 1">
                    <div class="card-body">
                        <h5 class="card-title">Upacara Bendera</h5>
                        <p class="card-text">Kegiatan upacara bendera setiap hari Senin untuk meningkatkan kedisiplinan dan nasionalisme siswa.</p>
                        <p class="text-muted"><small><i class="fas fa-calendar-alt"></i> 12 Maret 2024</small></p>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 2 -->
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Kegiatan 2">
                    <div class="card-body">
                        <h5 class="card-title">Praktikum Komputer</h5>
                        <p class="card-text">Siswa melakukan praktikum di laboratorium komputer untuk mengembangkan keterampilan programming.</p>
                        <p class="text-muted"><small><i class="fas fa-calendar-alt"></i> 10 Maret 2024</small></p>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 3 -->
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Kegiatan 3">
                    <div class="card-body">
                        <h5 class="card-title">Ekstrakurikuler Robotik</h5>
                        <p class="card-text">Kegiatan ekstrakurikuler robotik untuk mengembangkan kreativitas dan inovasi siswa.</p>
                        <p class="text-muted"><small><i class="fas fa-calendar-alt"></i> 8 Maret 2024</small></p>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 4 -->
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Kegiatan 4">
                    <div class="card-body">
                        <h5 class="card-title">Lomba Web Design</h5>
                        <p class="card-text">Siswa berpartisipasi dalam lomba web design tingkat provinsi.</p>
                        <p class="text-muted"><small><i class="fas fa-calendar-alt"></i> 5 Maret 2024</small></p>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 5 -->
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Kegiatan 5">
                    <div class="card-body">
                        <h5 class="card-title">Kunjungan Industri</h5>
                        <p class="card-text">Kunjungan ke perusahaan IT untuk mengenal dunia kerja secara langsung.</p>
                        <p class="text-muted"><small><i class="fas fa-calendar-alt"></i> 1 Maret 2024</small></p>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 6 -->
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Kegiatan 6">
                    <div class="card-body">
                        <h5 class="card-title">Workshop Programming</h5>
                        <p class="card-text">Workshop programming bersama praktisi IT dari industri.</p>
                        <p class="text-muted"><small><i class="fas fa-calendar-alt"></i> 28 Februari 2024</small></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
