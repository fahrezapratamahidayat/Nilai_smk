<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Rapor Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .school-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .student-info {
            margin-bottom: 20px;
        }
        .student-info table {
            width: 100%;
            margin-bottom: 20px;
        }
        .student-info td {
            padding: 5px;
        }
        .grades-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .grades-table th, .grades-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .grades-table th {
            background-color: #f0f0f0;
        }
        .footer {
            margin-top: 50px;
        }
        .signature {
            float: right;
            width: 200px;
            text-align: center;
        }
        @page {
            margin: 1cm;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="school-name">SMK INDONESIA</div>
        <div>Jl. Pendidikan No. 123, Jakarta</div>
        <div>Telp: (021) 1234567</div>
    </div>

    <div class="student-info">
        <table>
            <tr>
                <td width="150">Nama Siswa</td>
                <td width="10">:</td>
                <td>{{ $siswa->name }}</td>
            </tr>
            <tr>
                <td>NIS</td>
                <td>:</td>
                <td>{{ $siswa->siswa->nis }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>{{ $siswa->siswa->kelas }}</td>
            </tr>
            <tr>
                <td>Semester</td>
                <td>:</td>
                <td>{{ $semester == '1' ? 'Ganjil' : 'Genap' }}</td>
            </tr>
            <tr>
                <td>Tahun Ajaran</td>
                <td>:</td>
                <td>{{ $tahunAjaran }}</td>
            </tr>
        </table>
    </div>

    <table class="grades-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
                <th>Guru</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilai as $n)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $n->mata_pelajaran }}</td>
                <td>{{ number_format($n->nilai, 2) }}</td>
                <td>{{ $n->guru ? $n->guru->name : 'Guru tidak ditemukan' }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="text-align: right"><strong>Rata-rata</strong></td>
                <td colspan="3"><strong>{{ number_format($rataRata, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <div class="signature">
            <p>Jakarta, {{ Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
            <p>Wali Kelas</p>
            <br><br><br>
            <p>_______________________</p>
            <p>NIP.</p>
        </div>
    </div>
</body>
</html>
