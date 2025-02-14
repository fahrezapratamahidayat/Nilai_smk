@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Nilai</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.nilai.update', $nilai->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Siswa</label>
                            <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                <option value="">Pilih Siswa</option>
                                @foreach($siswa as $s)
                                <option value="{{ $s->id }}" {{ $nilai->user_id == $s->id ? 'selected' : '' }}>
                                    {{ $s->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label>
                            <input type="text" class="form-control @error('mata_pelajaran') is-invalid @enderror"
                                   id="mata_pelajaran" name="mata_pelajaran" value="{{ old('mata_pelajaran', $nilai->mata_pelajaran) }}">
                            @error('mata_pelajaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nilai" class="form-label">Nilai</label>
                            <input type="number" class="form-control @error('nilai') is-invalid @enderror"
                                   id="nilai" name="nilai" value="{{ old('nilai', $nilai->nilai) }}" min="0" max="100">
                            @error('nilai')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-select @error('semester') is-invalid @enderror" id="semester" name="semester">
                                <option value="1" {{ $nilai->semester == '1' ? 'selected' : '' }}>Ganjil</option>
                                <option value="2" {{ $nilai->semester == '2' ? 'selected' : '' }}>Genap</option>
                            </select>
                            @error('semester')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                            <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                   id="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', $nilai->tahun_ajaran) }}">
                            @error('tahun_ajaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.nilai.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
