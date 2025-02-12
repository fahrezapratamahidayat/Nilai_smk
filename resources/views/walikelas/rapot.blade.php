@extends('layouts.walikelas')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Rapot Siswa</h2>
            <button class="btn btn-primary">
                <i class="fas fa-print"></i> Cetak Rapot
            </button>
        </div>

        <div class="card">
            <div class="card-body">
                <form class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label">Pilih Siswa</label>
                        <select class="form-select">
                            <option selected disabled>Pilih Siswa...</option>
                            @foreach($siswa ?? [] as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Semester</label>
                        <select class="form-select">
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                    </div>
                    <div class="col-md-4">
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
                                <th>KKM</th>
                                <th>Nilai</th>
                                <th>Predikat</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Matematika</td>
                                <td>75</td>
                                <td>85</td>
                                <td>A</td>
                                <td>Sangat baik dalam memahami konsep matematika</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
