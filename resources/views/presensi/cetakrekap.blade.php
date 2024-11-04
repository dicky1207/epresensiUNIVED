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

    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4 landscape">

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
            <th colspan="{{ $jmlhari }}">Bulan {{ $namabulan[$bulan] }} {{ $tahun }}</th>
            <th rowspan="2">TH</th>
            <th rowspan="2">TK</th>
        </tr>
        <tr>
            @foreach ($rangetanggal as $d)
            @if($d != NULL)
            <th>{{ date("d", strtotime($d)) }}</th>
            @endif
            @endforeach
        </tr>
    </table>
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