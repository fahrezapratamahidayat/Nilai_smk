@extends('layouts.siswa')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Dashboard Siswa</h2>
    </div>

    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Mata Pelajaran</h5>
                <p class="card-text display-4">10</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Rata-rata Nilai</h5>
                <p class="card-text display-4">85.5</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Kehadiran</h5>
                <p class="card-text display-4">95%</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Jadwal Pelajaran Hari Ini</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Jam</th>
                                <th>Mata Pelajaran</th>
                                <th>Guru</th>
                                <th>Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>07:00 - 08:30</td>
                                <td>Matematika</td>
                                <td>Pak Budi</td>
                                <td>R.101</td>
                            </tr>
                            <tr>
                                <td>08:30 - 10:00</td>
                                <td>Bahasa Indonesia</td>
                                <td>Bu Siti</td>
                                <td>R.101</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
