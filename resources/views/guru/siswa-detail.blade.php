@extends('layouts.guru')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Detail Siswa</h2>
            <a href="{{ route('guru.siswa') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        @if($siswa->siswa->foto)
                            <img src="{{ asset('storage/foto_siswa/' . $siswa->siswa->foto) }}"
                                 alt="Foto {{ $siswa->name }}"
                                 class="img-fluid rounded mb-3">
                        @else
                            <div class="text-center p-3 bg-light mb-3">
                                <i class="fas fa-user fa-4x text-secondary"></i>
                            </div>
                        @endif

                        <h4 class="card-title">{{ $siswa->name }}</h4>
                        <p class="text-muted">NIS: {{ $siswa->siswa->nis }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informasi Siswa</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Kelas</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $siswa->siswa->kelas }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Jenis Kelamin</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Tempat, Tanggal Lahir</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d F Y') }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Alamat</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $siswa->alamat }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Riwayat Nilai</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Nilai</th>
                                        <th>Semester</th>
                                        <th>Tahun Ajaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($siswa->nilai as $nilai)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $nilai->mata_pelajaran }}</td>
                                        <td>{{ $nilai->nilai }}</td>
                                        <td>{{ $nilai->semester == '1' ? 'Ganjil' : 'Genap' }}</td>
                                        <td>{{ $nilai->tahun_ajaran }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data nilai</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
