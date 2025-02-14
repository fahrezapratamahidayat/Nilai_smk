@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Nilai Siswa</h2>
        <a href="{{ route('admin.nilai.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Nilai
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilai as $index => $n)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $n->siswa->name }}</td>
                            <td>{{ $n->mata_pelajaran }}</td>
                            <td>{{ $n->nilai }}</td>
                            <td>{{ $n->semester == '1' ? 'Ganjil' : 'Genap' }}</td>
                            <td>{{ $n->tahun_ajaran }}</td>
                            <td>
                                <a href="{{ route('admin.nilai.edit', $n->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.nilai.destroy', $n->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus nilai ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
