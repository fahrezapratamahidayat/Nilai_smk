@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Tambah Wali Kelas</h2>
            <a href="{{ route('admin.walikelas.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.walikelas.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Pilih Guru</label>
                        <select class="form-select @error('user_id') is-invalid @enderror"
                                name="user_id" required>
                            <option value="">Pilih Guru</option>
                            @foreach($guru as $g)
                                <option value="{{ $g->id }}" {{ old('user_id') == $g->id ? 'selected' : '' }}>
                                    {{ $g->name }} - {{ $g->guru->nip }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select class="form-select @error('kelas') is-invalid @enderror"
                                name="kelas" required>
                            <option value="">Pilih Kelas</option>
                            <option value="10" {{ old('kelas') == '10' ? 'selected' : '' }}>10</option>
                            <option value="11" {{ old('kelas') == '11' ? 'selected' : '' }}>11</option>
                            <option value="12" {{ old('kelas') == '12' ? 'selected' : '' }}>12</option>
                        </select>
                        @error('kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
