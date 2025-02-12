@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Manajemen Guru</h2>
            <a href="{{ route('admin.guru.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Guru
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>TTL</th>
                                <th>Alamat</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($guru as $g)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $g->nip ?? '-' }}</td>
                                <td>{{ $g->name }}</td>
                                <td>{{ $g->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $g->tempat_lahir }}, {{ $g->tanggal_lahir ? \Carbon\Carbon::parse($g->tanggal_lahir)->format('d-m-Y') : '-' }}</td>
                                <td>{{ $g->alamat ?? '-' }}</td>
                                <td>{{ $g->mata_pelajaran ?? '-' }}</td>
                                <td>{{ $g->kelas_ajar ? 'Kelas ' . $g->kelas_ajar : '-' }}</td>
                                <td>
                                    @if($g->status_guru == 'wali_kelas')
                                        <span class="badge bg-primary">Wali Kelas</span>
                                    @else
                                        <span class="badge bg-info">Guru Mapel</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.guru.edit', $g->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.guru.destroy', $g->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
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
</div>
@endsection
