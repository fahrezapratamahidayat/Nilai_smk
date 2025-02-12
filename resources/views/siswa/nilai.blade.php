@extends('layouts.siswa')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Nilai Akademik</h2>
            <button class="btn btn-primary">
                <i class="fas fa-download"></i> Download Rapor
            </button>
        </div>

        <div class="card">
            <div class="card-body">
                <form class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Semester</label>
                        <select class="form-select">
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tahun Ajaran</label>
                        <select class="form-select">
                            <option value="2023/2024">2023/2024</option>
                            <option value="2024/2025">2024/2025</option>
                        </select>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>Tugas</th>
                                <th>UTS</th>
                                <th>UAS</th>
                                <th>Nilai Akhir</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nilai ?? [] as $n)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $n->mata_pelajaran }}</td>
                                <td>{{ $n->tugas }}</td>
                                <td>{{ $n->uts }}</td>
                                <td>{{ $n->uas }}</td>
                                <td>{{ $n->nilai_akhir }}</td>
                                <td>{{ $n->grade }}</td>
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
