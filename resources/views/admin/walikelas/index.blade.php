@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Wali Kelas</h2>
            <a href="{{ route('admin.walikelas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Wali Kelas
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Kelas yang Diajar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($walikelas as $index => $wali)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $wali->name }}</td>
                            <td>{{ $wali->email }}</td>
                            <td>{{ $wali->kelas_ajar }}</td>
                            <td>
                                <a href="{{ route('admin.walikelas.edit', $wali->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.walikelas.destroy', $wali->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus wali kelas ini?')">
                                        <i class="fas fa-trash"></i> Hapus
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
