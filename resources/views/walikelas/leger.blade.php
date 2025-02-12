@extends('layouts.walikelas')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Leger Nilai</h2>
            <button class="btn btn-primary">
                <i class="fas fa-print"></i> Cetak Leger
            </button>
        </div>

        <div class="card">
            <div class="card-body">
                <form class="row g-3 mb-4">
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
                    <div class="col-md-4">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary d-block">Tampilkan</button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th rowspan="2" class="align-middle">No</th>
                                <th rowspan="2" class="align-middle">Nama Siswa</th>
                                <th colspan="10" class="text-center">Mata Pelajaran</th>
                                <th rowspan="2" class="align-middle">Rata-rata</th>
                            </tr>
                            <tr>
                                <th>MTK</th>
                                <th>B.IND</th>
                                <th>B.ING</th>
                                <th>IPA</th>
                                <th>IPS</th>
                                <th>PKN</th>
                                <th>PAI</th>
                                <th>PJOK</th>
                                <th>SBK</th>
                                <th>TIK</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa ?? [] as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->name }}</td>
                                <td>85</td>
                                <td>80</td>
                                <td>75</td>
                                <td>90</td>
                                <td>85</td>
                                <td>80</td>
                                <td>85</td>
                                <td>90</td>
                                <td>85</td>
                                <td>80</td>
                                <td>83.5</td>
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
