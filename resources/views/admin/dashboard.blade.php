@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Dashboard Admin</h2>
    </div>

    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Total Guru</h5>
                <p class="card-text display-4">{{ App\Models\User::where('role', 'guru')->count() }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Total Wali Kelas</h5>
                <p class="card-text display-4">{{ App\Models\User::where('role', 'walikelas')->count() }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-info text-white">
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
                <h5 class="card-title mb-0">Aktivitas Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Aktivitas</th>
                                <th>User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ now()->format('d/m/Y H:i') }}</td>
                                <td>Login ke sistem</td>
                                <td>{{ auth()->user()->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
