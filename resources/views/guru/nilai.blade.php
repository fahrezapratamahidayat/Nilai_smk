@extends('layouts.guru')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Input Nilai Siswa</h2>
        </div>

        <div class="card">
            <div class="card-body">
                <form class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label class="form-label">Kelas</label>
                        <select class="form-select" required>
                            <option value="">Pilih Kelas...</option>
                            <option value="X RPL 1">X RPL 1</option>
                            <option value="X RPL 2">X RPL 2</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Mata Pelajaran</label>
                        <select class="form-select" required>
                            <option value="">Pilih Mapel...</option>
                            <option value="Matematika">Matematika</option>
                            <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jenis Penilaian</label>
                        <select class="form-select" required>
                            <option value="">Pilih Jenis...</option>
                            <option value="UTS">UTS</option>
                            <option value="UAS">UAS</option>
                            <option value="Tugas">Tugas</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary d-block w-100">Tampilkan</button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa ?? [] as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->nisn ?? '-' }}</td>
                                <td>{{ $s->name }}</td>
                                <td width="150">
                                    <input type="number" class="form-control" min="0" max="100" value="{{ $s->nilai ?? '' }}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Nilai
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
