@extends('layouts.guru')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Dashboard Guru</h2>
    </div>

    <div class="col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Total Kelas</h5>
                <p class="card-text display-4">3</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Total Siswa</h5>
                <p class="card-text display-4">{{ App\Models\User::where('role', 'siswa')->count() }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Jadwal Mengajar Hari Ini</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Jam</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>07:00 - 08:30</td>
                                <td>Matematika</td>
                                <td>X RPL 1</td>
                                <td>R.101</td>
                            </tr>
                            <tr>
                                <td>08:30 - 10:00</td>
                                <td>Matematika</td>
                                <td>X RPL 2</td>
                                <td>R.102</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
