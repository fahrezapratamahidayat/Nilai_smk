@extends('layouts.walikelas')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Dashboard Wali Kelas</h2>
    </div>

    <div class="col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Total Siswa</h5>
                <p class="card-text display-4">{{ App\Models\User::where('role', 'siswa')->count() }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Total Mata Pelajaran</h5>
                <p class="card-text display-4">10</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Daftar Siswa</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NISN</th>
                                <th>Rata-rata Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa ?? [] as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->name }}</td>
                                <td>{{ $s->nisn ?? '-' }}</td>
                                <td>80.5</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
