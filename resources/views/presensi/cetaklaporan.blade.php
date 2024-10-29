<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Cetak Laporan Presensi</title>
    <link rel="icon" type="image/png" href="{{ asset('tabler/static/favicon.png') }}" sizes="32x32">
  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
    @page {
        size: A4
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
       padding: 8px;
       background-color: #c2c2c2;
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
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

<?php
  //Function Untuk Menghitung Selisih Jam
  function selisih($jam_masuk, $jam_keluar)
        {
            list($h, $m, $s) = explode(":", $jam_masuk);
            $dtAwal = mktime($h, $m, $s, "1", "1", "1");
            list($h, $m, $s) = explode(":", $jam_keluar);
            $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
            $dtSelisih = $dtAkhir - $dtAwal;
            $totalmenit = $dtSelisih / 60;
            $jam = explode(".", $totalmenit / 60);
            $sisamenit = ($totalmenit / 60) - $jam[0];
            $sisamenit2 = $sisamenit * 60;
            $jml_jam = $jam[0];
            return $jml_jam . ":" . round($sisamenit2);
        }
?>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">
    <table style="width: 100%">
        <tr>
            <td style="width: 30px">
                <img src="{{ asset('assets/img/logopresensi.png') }}" width="70" height="70" alt="">
            </td>
            <td>
                <span id="title">
                    Laporan Presensi Pegawai<br>
                    Periode Bulan {{ $namabulan[$bulan] }} Tahun {{ $tahun }}<br>
                    Universitas Dehasen Bengkulu<br>
                </span>
                <span id="alamatunived"><u><i>Jl. Meranti Raya No. 32 Sawah Lebar Kota Bengkulu 38228 Telp: (0736) 22027</i></u></span>
            </td>
        </tr>
    </table>
    <table class="tabeldatapegawai">
        <tr>
            <td rowspan="6">
                @php
                    $path = Storage::url('uploads/pegawai/'.$pegawai->foto);
                @endphp
                <img src="{{ url($path) }}" alt="" width="120" height="150">
            </td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $pegawai->nik }}</td>
        </tr>
        <tr>
            <td>Nama Pegawai</td>
            <td>:</td>
            <td>{{ $pegawai->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $pegawai->jabatan }}</td>
        </tr>
        <tr>
            <td>Departemen</td>
            <td>:</td>
            <td>{{ $pegawai->nama_dept }}</td>
        </tr>
        <tr>
            <td>No. Handphone</td>
            <td>:</td>
            <td>{{ $pegawai->no_hp }}</td>
        </tr>
    </table>
    <table class="tabelpresensi">
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Foto</th>
            <th>Jam Pulang</th>
            <th>Foto</th>
            <th>Keterangan</th>
            <th>Jumlah Jam Kerja</th>
        </tr>
        @foreach ($presensi as $d)
        @php
            $path_in = Storage::url('uploads/absensi/'.$d->foto_in);
            $path_out = Storage::url('uploads/absensi/'.$d->foto_out);
            $jamterlambat = selisih('09:00:00',$d->jam_in)
        @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</td>
                <td>{{ $d->jam_in != null ? $d->jam_in : 'Belum Absen' }}</td>
                <td><img src="{{ url($path_in) }}" class="foto" alt=""></td>
                <td>{{ $d->jam_out != null ? $d->jam_out : 'Belum Absen' }}</td>
                <td>
                    @if($d->jam_out != null)
                    <img src="{{ url($path_out) }}" class="foto" alt="">
                    @else
                    <img src="{{ asset('assets/img/camera.png') }}" class="foto" alt="">
                    @endif
                </td>
                <td>
                    @if($d->jam_in > '09:00')
                        Terlambat {{ $jamterlambat }}
                    @else
                        Tepat Waktu
                    @endif
                </td>
                <td>
                    @if($d->jam_out != null)
                        @php
                            $jmljamkerja = selisih($d->jam_in, $d->jam_out);
                        @endphp
                        @else
                        @php
                            $jmljamkerja = 0;
                        @endphp
                    @endif
                    {{ $jmljamkerja }}
                </td>
            </tr>
        @endforeach
    </table>
    <table width="100%" style="margin-top: 100px">
        <tr>
            <td colspan="2" style="text-align: right; padding-right: 30px">Bengkulu, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td style="text-align: right; vertical-align: bottom; padding-right: 47px" height="100px">
                <b>Admin Kepegawaian</b>
            </td>
        </tr>
    </table>
  </section>
</body>
</html>