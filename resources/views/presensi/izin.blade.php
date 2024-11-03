@extends('layouts.presensi')
@section('header')
 <!-- App Header -->
 <div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Data Cuti/Izin</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection
<?php
function hitunghari($tanggal_awal, $tanggal_akhir){
    $tanggal_1 = date_create($tanggal_awal);
    $tanggal_2 = date_create($tanggal_akhir); // waktu sekarang
    $diff = date_diff( $tanggal_1, $tanggal_2 );
    return $diff->days + 1;
}
?>
@section('content')
<div class="row" style="margin-top: 70px">
    <div class="col">
        @php
        $messagesuccess = Session::get('success');
        $messageerror = Session::get('error');
    @endphp
    @if(Session::get('success'))
        <div class="alert alert-success">
            {{ $messagesuccess }}
        </div>
    @endif
    @if(Session::get('error'))
        <div class="alert alert-danger">
            {{ $messageerror }}
        </div>
    @endif
    </div>
</div>
<div class="row">
    <div class="col">
    @foreach ($dataizin as $d)
    <div class="card mb-2">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="iconpresensi" style="padding-right: 8px;"> <!-- Menambahkan padding kanan -->
                    @if ($d->status_approvement == "0")
                        <ion-icon name="help" style="font-size: 40px;" class="text-warning"></ion-icon>
                    @elseif($d->status_approvement == "1")
                        <ion-icon name="checkmark-done" style="font-size: 40px;" class="text-success"></ion-icon>
                    @elseif($d->status_approvement == "2")
                        <ion-icon name="close" style="font-size: 40px;" class="text-danger"></ion-icon>
                    @endif
                </div>
                <div class="flex-grow-1">
                    <b>{{ date("d-m-Y", strtotime($d->tgl_awal)) }} s/d {{ date("d-m-Y", strtotime($d->tgl_akhir)) }}
                    ({{ $d->status == "c" ? "Cuti" : "Izin" }} {{ hitunghari($d->tgl_awal, $d->tgl_akhir) }} Hari)</b><br>
                    <small class="text-muted">{{ $d->keterangan }}</small>
                </div>
                <div>
                    @if($d->status_approvement == 0)
                        <span class="badge bg-warning">Waiting</span>
                    @elseif($d->status_approvement == 1)
                        <span class="badge bg-success">Disetujui</span>
                    @elseif($d->status_approvement == 2)
                        <span class="badge bg-danger">Ditolak</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- <ul class="listview image-listview">
        <li>
            <div class="item">
                <div class="in">
                    <div>
                        <b>{{ date("d-m-Y", strtotime($d->tgl_awal)) }} s/d {{ date("d-m-Y", strtotime($d->tgl_akhir)) }}  ({{ $d->status == "c" ? "Cuti" : "Izin" }})</b><br>
                        <small class="text-muted">{{ $d->keterangan }}</small>
                    </div>
                    @if($d->status_approvement == 0)
                        <span class="badge bg-warning">Waiting</span>
                    @elseif ($d->status_approvement == 1)
                    <span class="badge bg-success">Disetujui</span>
                    @elseif ($d->status_approvement == 2)
                    <span class="badge bg-danger">Ditolak</span>
                    @endif
                </div>
            </div>
        </li>
    </ul> --}}
    @endforeach
    </div>
</div>
<div class="fab-button bottom-right" style="margin-bottom: 70px">
    <a href="/presensi/ajukanizin" class="fab">
        <ion-icon name="add"></ion-icon>
    </a>
</div>
@endsection