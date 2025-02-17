@extends('layouts.walikelas')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Leger Nilai Kelas {{ auth()->user()->guru->kelas_ajar }}</h2>
            <form action="{{ route('walikelas.leger') }}" method="GET">
                <input type="hidden" name="download" value="1">
                <input type="hidden" name="semester" value="{{ $semester }}">
                <input type="hidden" name="tahun_ajaran" value="{{ $tahunAjaran }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-download"></i> Download Leger
                </button>
            </form>
        </div>

        <div class="card">
            <div class="card-body">
                <form class="row g-3 mb-4" method="GET">
                    <div class="col-md-4">
                        <label class="form-label">Semester</label>
                        <select name="semester" class="form-select" onchange="this.form.submit()">
                            <option value="1" {{ $semester == '1' ? 'selected' : '' }}>Ganjil</option>
                            <option value="2" {{ $semester == '2' ? 'selected' : '' }}>Genap</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tahun Ajaran</label>
                        <select name="tahun_ajaran" class="form-select" onchange="this.form.submit()">
                            <option value="2023/2024" {{ $tahunAjaran == '2023/2024' ? 'selected' : '' }}>2023/2024</option>
                            <option value="2024/2025" {{ $tahunAjaran == '2024/2025' ? 'selected' : '' }}>2024/2025</option>
                        </select>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th rowspan="2" class="align-middle">Peringkat</th>
                                <th rowspan="2" class="align-middle">Nama Siswa</th>
                                @foreach($mataPelajaran as $mapel)
                                    <th>{{ $mapel }}</th>
                                @endforeach
                                <th rowspan="2" class="align-middle">Rata-rata</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peringkat as $index => $siswaId)
                                @php
                                    $s = $siswa->firstWhere('id', $siswaId);
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $s->name }}</td>
                                    @foreach($mataPelajaran as $mapel)
                                        <td>{{ $nilaiSiswa[$s->id][$mapel]->nilai ?? '-' }}</td>
                                    @endforeach
                                    <td class="fw-bold">{{ $rataRataSiswa[$s->id] }}</td>
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
