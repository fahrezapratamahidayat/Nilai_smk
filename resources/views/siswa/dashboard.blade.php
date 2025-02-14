@extends('layouts.siswa')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Dashboard Siswa</h2>
        <p class="text-muted">Selamat datang, {{ auth()->user()->name }} - Kelas {{ auth()->user()->siswa->kelas }}</p>
    </div>

    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Mata Pelajaran</h5>
                <p class="card-text display-4">{{ $jumlahMapel }}</p>
                <small>Total mata pelajaran di kelas {{ auth()->user()->siswa->kelas }}</small>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Rata-rata Nilai</h5>
                <p class="card-text display-4">{{ number_format($nilaiRataRata, 1) }}</p>
                <small>Rata-rata dari semua mata pelajaran</small>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Kehadiran</h5>
                <p class="card-text display-4">95%</p>
                <small>Persentase kehadiran semester ini</small>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Jadwal Mata Pelajaran</h5>
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
                            @forelse($jadwalHariIni as $jadwal)
                            <tr>
                                <td>{{ $jadwal['jam'] }}</td>
                                <td>{{ $jadwal['mapel'] }}</td>
                                <td>{{ $jadwal['guru'] }}</td>
                                <td>{{ $jadwal['ruangan'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada jadwal hari ini</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
