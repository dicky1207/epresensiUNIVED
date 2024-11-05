<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Cetak Rekap Presensi</title>
  <link rel="icon" type="image/png" href="{{ asset('tabler/static/favicon.png') }}" sizes="32x32">
  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
    @page {
        size: A4;
    }

    body.A4.landscape .sheet{
        width: 297mm !important;
        height: auto !important;
    }

    #title {
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        font-size: 18px;
        font-weight: bold;
    }

    #alamatunived{
        font-size: 13px;
    }

    .tabeldatapegawai{
        margin-top: 90px;
    }

    .tabeldatapegawai td{
        padding: 5px;
    }

    .tabelpresensi{
        width: 100%;
        margin-top: 30px;
        border-collapse: collapse;
    }

    .tabelpresensi tr th{
       border: 1px solid #131212;
       padding: 5px;
       background-color: #c2c2c2;
       font-size: 10px;
    }

    .tabelpresensi tr td{
       border: 1px solid #131212;
       padding: 5px;
       font-size: 12px;
    }

    .foto{
        width: 40px;
        height: 30px;
    }

    .keterangan {
        font-size: 12px;
        margin-top: 20px;
    }

    </style>
</head>

<body class="A4 landscape">
  <section class="sheet padding-10mm">
    <table style="width: 100%">
        <tr>
            <td style="width: 30px">
                <img src="{{ asset('assets/img/logopresensi.png') }}" width="70" height="70" alt="">
            </td>
            <td>
                <span id="title">
                    Rekap Presensi Pegawai<br>
                    Periode Bulan {{ $namabulan[$bulan] }} Tahun {{ $tahun }}<br>
                    Universitas Dehasen Bengkulu<br>
                </span>
                <span id="alamatunived"><u><i>Jl. Meranti Raya No. 32 Sawah Lebar Kota Bengkulu 38228 Telp: (0736) 22027</i></u></span>
            </td>
        </tr>
    </table>

    <table class="tabelpresensi">
        <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">NIK</th>
            <th rowspan="2">Nama Pegawai</th>
            <th colspan="{{ $jmlhari }}">Tanggal</th>
            <th rowspan="2">TH</th>
            <th rowspan="2">TC</th>
            <th rowspan="2">TI</th>
            <th rowspan="2">TA</th>
        </tr>
        <tr>
            @for ($tgl = 1; $tgl <= $jmlhari; $tgl++)
                <th>{{ $tgl }}</th>
            @endfor
        </tr>
        @foreach ($rekap as $pegawai)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $pegawai['nik'] }}</td>
            <td>{{ $pegawai['nama_lengkap'] }}</td>
            @for ($tgl = 1; $tgl <= $jmlhari; $tgl++)
            @if ($pegawai["tgl_$tgl"] === '✓')
            <td style="color: green; font-weight: bold;">{{ $pegawai["tgl_$tgl"] }}</td>
            @elseif ($pegawai["tgl_$tgl"] === '✗')
            <td style="color: red; font-weight: bold;">{{ $pegawai["tgl_$tgl"] }}</td>
            @elseif ($pegawai["tgl_$tgl"] === 'c')
            <td style="color: blue; font-weight: bold;">{{ $pegawai["tgl_$tgl"] }}</td>
            @elseif ($pegawai["tgl_$tgl"] === 'i')
            <td style="color: orange; font-weight: bold;">{{ $pegawai["tgl_$tgl"] }}</td>
            @else
            <td>{{ $pegawai["tgl_$tgl"] ?? '' }}</td>
            @endif
            @endfor
            <td style="color: green;">{{ $pegawai['totalHadir'] }}</td>
            <td style="color: blue;">{{ $pegawai['totalCuti'] }}</td>
            <td style="color: orange;">{{ $pegawai['totalIzin'] }}</td>
            <td style="color: red;">{{ $pegawai['totalAlpa'] }}</td>
        </tr>
        @endforeach
    </table>

    <!-- Keterangan untuk TH, TC, TI dan TA -->
    <div class="keterangan">
        <p><strong>Keterangan Simbol:</strong> ✓ = Hadir, ✗ = Alpa, c = Cuti, i = Izin</p>
        <p><strong>Keterangan:</strong> TH = Total Hadir, TC = Total Cuti, TI = Total Izin, TA = Total Alpa</p>
    </div>

    <table width="100%" style="margin-top: 100px">
        <tr>
            <td colspan="2" style="text-align: right; padding-right: 30px">Bengkulu, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td style="text-align: right; vertical-align: bottom; padding-right: 60px" height="100px">
                <b>Yupianti, M.Kom</b>
            </td>
        </tr>
    </table>
  </section>
</body>
</html>