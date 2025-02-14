@extends('layouts.siswa')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Nilai Akademik</h2>
            <form id="downloadForm" action="{{ route('siswa.download-rapor') }}" method="GET" class="d-inline">
                <input type="hidden" name="semester" value="{{ $semester }}">
                <input type="hidden" name="tahun_ajaran" value="{{ $tahunAjaran }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-download"></i> Download Rapor
                </button>
            </form>
        </div>

        <div class="card">
            <div class="card-body">
                <form class="row g-3 mb-4" method="GET" action="{{ route('siswa.nilai') }}">
                    <div class="col-md-4">
                        <label class="form-label">Semester</label>
                        <select class="form-select" name="semester" onchange="this.form.submit()">
                            <option value="1" {{ $semester == '1' ? 'selected' : '' }}>Ganjil</option>
                            <option value="2" {{ $semester == '2' ? 'selected' : '' }}>Genap</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tahun Ajaran</label>
                        <select class="form-select" name="tahun_ajaran" onchange="this.form.submit()">
                            @foreach($tahunAjaranList as $ta)
                                <option value="{{ $ta }}" {{ $tahunAjaran == $ta ? 'selected' : '' }}>
                                    {{ $ta }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>Nilai</th>
                                <th>Grade</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($nilai as $n)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $n->mata_pelajaran }}</td>
                                <td>{{ $n->nilai }}</td>
                                <td>
                                    @php
                                        $grade = '';
                                        if ($n->nilai >= 90) $grade = 'A';
                                        elseif ($n->nilai >= 80) $grade = 'B';
                                        elseif ($n->nilai >= 70) $grade = 'C';
                                        elseif ($n->nilai >= 60) $grade = 'D';
                                        else $grade = 'E';
                                    @endphp
                                    {{ $grade }}
                                </td>
                                <td>{{ $n->semester == '1' ? 'Ganjil' : 'Genap' }}</td>
                                <td>{{ $n->tahun_ajaran }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data nilai</td>
                            </tr>
                            @endforelse
                        </tbody>
                        @if($nilai->count() > 0)
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="2" class="text-end"><strong>Rata-rata</strong></td>
                                <td colspan="4"><strong>{{ number_format($nilai->avg('nilai'), 2) }}</strong></td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('#downloadForm').on('submit', function(e) {
        e.preventDefault();

        const btn = $(this).find('button[type="submit"]');
        const originalText = btn.html();
        btn.html('<i class="fas fa-spinner fa-spin"></i> Mengunduh...');
        btn.prop('disabled', true);

        $.ajax({
            url: $(this).attr('action'),
            method: 'GET',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    // Buat blob dari base64 PDF
                    const byteCharacters = atob(response.file);
                    const byteNumbers = new Array(byteCharacters.length);
                    for (let i = 0; i < byteCharacters.length; i++) {
                        byteNumbers[i] = byteCharacters.charCodeAt(i);
                    }
                    const byteArray = new Uint8Array(byteNumbers);
                    const blob = new Blob([byteArray], {type: 'application/pdf'});

                    // Buat URL dan buka di tab baru
                    const url = window.URL.createObjectURL(blob);
                    window.open(url, '_blank');
                } else {
                    alert('Terjadi kesalahan saat mengunduh rapor');
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                alert(response?.error || 'Terjadi kesalahan saat mengunduh rapor');
            },
            complete: function() {
                btn.html(originalText);
                btn.prop('disabled', false);
            }
        });
    });
});
</script>
@endpush
@endsection
