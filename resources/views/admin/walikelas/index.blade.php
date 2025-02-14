@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Manajemen Wali Kelas</h2>
            <a href="{{ route('admin.walikelas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Wali Kelas
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Wali Kelas</th>
                                <th>NIP</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($walikelas as $wk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $wk->name }}</td>
                                <td>{{ $wk->guru->nip }}</td>
                                <td>{{ $wk->kelas }}</td>
                                <td>
                                    <a href="{{ route('admin.walikelas.edit', $wk->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.walikelas.destroy', $wk->id) }}" method="POST" class="d-inline">
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
