@extends('layouts.guru')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Input Nilai {{ $mataPelajaran }} - Kelas {{ $kelasAjar }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('guru.store-nilai') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Siswa</label>
                                    <select name="siswa_id" class="form-select select2-siswa" required>
                                        <option value="">Cari Siswa...</option>
                                        @foreach($siswaList as $siswa)
                                            <option value="{{ $siswa->id }}">
                                                {{ $siswa->name }} - {{ $siswa->siswa->kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Nilai</label>
                                    <input type="number" name="nilai" class="form-control"
                                           min="0" max="100" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Semester</label>
                                    <select name="semester" class="form-select" required>
                                        <option value="">Pilih Semester</option>
                                        <option value="1">Ganjil</option>
                                        <option value="2">Genap</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Tahun Ajaran</label>
                                    <input type="text" name="tahun_ajaran" class="form-control"
                                           placeholder="2023/2024" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Nilai -->
        <div class="modal fade" id="editNilaiModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Nilai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="editNilaiForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Siswa</label>
                                <input type="text" id="edit_siswa" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label>Nilai</label>
                                <input type="number" name="nilai" id="edit_nilai" class="form-control"
                                       min="0" max="100" required>
                            </div>
                            <div class="mb-3">
                                <label>Semester</label>
                                <select name="semester" id="edit_semester" class="form-select" required>
                                    <option value="1">Ganjil</option>
                                    <option value="2">Genap</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Tahun Ajaran</label>
                                <input type="text" name="tahun_ajaran" id="edit_tahun_ajaran"
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar Nilai {{ $mataPelajaran }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Nilai</th>
                                    <th>Semester</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($nilaiList as $nilai)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $nilai->siswa->name }}</td>
                                    <td>{{ $nilai->siswa->siswa->kelas }}</td>
                                    <td>{{ $nilai->nilai }}</td>
                                    <td>{{ $nilai->semester == '1' ? 'Ganjil' : 'Genap' }}</td>
                                    <td>{{ $nilai->tahun_ajaran }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning edit-nilai"
                                                data-id="{{ $nilai->id }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('guru.nilai.destroy', $nilai->id) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus nilai ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data nilai</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi Select2 untuk pencarian siswa
    $('.select2-siswa').select2({
        theme: 'bootstrap-5',
        placeholder: 'Cari nama siswa...',
        allowClear: true,
        width: '100%',
        language: {
            noResults: function() {
                return "Siswa tidak ditemukan";
            },
            searching: function() {
                return "Mencari...";
            }
        }
    });

    // Kode untuk edit nilai
    $('.edit-nilai').click(function() {
        const id = $(this).data('id');

        $.get("{{ url('guru/nilai') }}/" + id + "/edit", function(data) {
            $('#edit_siswa').val(data.siswa.name);
            $('#edit_nilai').val(data.nilai);
            $('#edit_semester').val(data.semester);
            $('#edit_tahun_ajaran').val(data.tahun_ajaran);

            $('#editNilaiForm').attr('action', "{{ url('guru/nilai') }}/" + id);

            $('#editNilaiModal').modal('show');
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error('Error:', errorThrown);
            alert('Terjadi kesalahan saat mengambil data nilai');
        });
    });
});
</script>

<style>
/* Custom style untuk Select2 */
.select2-container--bootstrap-5 .select2-selection {
    min-height: 38px;
    padding: 0.375rem 0.75rem;
}
.select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
    padding: 0;
    line-height: 1.5;
}
</style>
@endpush
@endsection
