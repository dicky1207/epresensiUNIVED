@extends('layouts.presensi')
@section('content')
<style>
    .logout {
        position: absolute;
        color: white;
        font-size: 35px;
        text-decoration: none;
        right: 8px;
        top: 5px;
    }

    .logout:hover {
        color: white;
    }

    #user-name {
        font-size: 18px !important;
    }

    #user-role {
        font-size: 13px !important;
    }
</style>
<div class="section" id="user-section">
    <a href="/proseslogout" class="logout">
        <ion-icon name="log-out-outline"></ion-icon>
    </a>
    <div id="user-detail">
        <div class="avatar">
            @if(!empty(Auth::guard('pegawai')->user()->foto))
            @php
                $path = Storage::url('uploads/pegawai/'.Auth::guard('pegawai')->user()->foto);
            @endphp
            <img src="{{ url($path) }}" alt="avatar" class="imaged w64" style="height: 60px">
            @else
            <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
            @endif
        </div>
        <div id="user-info">
            <h2 id="user-name">{{ Auth::guard('pegawai')->user()->nama_lengkap }}</h2>
            <span id="user-role">{{ Auth::guard('pegawai')->user()->jabatan }}</span>
        </div>
    </div>
</div>

<div class="section mt-2" id="presence-section">
    <br>
    <div class="row">
        <div class="col-6">
            <div class="card gradasigreen">
                <div class="card-body">
                    <div class="presencecontent">
                        <div class="iconpresence">
                                @if($presensihariini != null)
                                @php
                                    $path = Storage::url('uploads/absensi/'.$presensihariini->foto_in);
                                @endphp
                                <img src="{{ url($path) }}" alt="" class="imaged w48">   
                                @else
                                <ion-icon name="camera"></ion-icon>
                                @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Masuk</h4>
                                <span>{{ $presensihariini != null ? $presensihariini->jam_in : 'Belum Absen' }}</span>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </br>
            <div class="col-6">
                <div class="card gradasired">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if($presensihariini != null && $presensihariini->jam_out != null)
                                @php
                                    $path = Storage::url('uploads/absensi/'.$presensihariini->foto_out);
                                @endphp
                                <img src="{{ url($path) }}" alt="" class="imaged w48">   
                                @else
                                <ion-icon name="camera"></ion-icon>
                                @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Pulang</h4>
                                <span>{{ $presensihariini != null && $presensihariini->jam_out != null ? $presensihariini->jam_out : 'Belum Absen' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <br>
        <div id="rekappresensi">
            <h3>Rekap Presensi Bulan {{ $namabulan[$bulanini] }} Tahun {{ $tahunini }}</h3>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important; line-height:0.8rem">
                            <span class="badge bg-danger" style="position: absolute; top:3px; right:5px; font-size:0.6rem;
                            z-index:999">{{ $rekappresensi->jmlhadir != null ? $rekappresensi->jmlhadir : 0 }}</span>
                            <ion-icon name="accessibility" style="font-size: 1.6rem" class="text-primary mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Hadir</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important; line-height:0.8rem">
                            <span class="badge bg-danger" style="position: absolute; top:3px; right:5px; font-size:0.6rem;
                            z-index:999">{{ $rekapizin->jmlcuti != null ? $rekapizin->jmlcuti : 0 }}</span>
                            <ion-icon name="reader" style="font-size: 1.6rem" class="text-success mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Cuti</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important; line-height:0.8rem">
                            <span class="badge bg-danger" style="position: absolute; top:3px; right:5px; font-size:0.6rem;
                            z-index:999">{{ $rekapizin->jmlizin != null ? $rekapizin->jmlizin : 0 }}</span>
                            <ion-icon name="newspaper" style="font-size: 1.6rem" class="text-warning mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Izin</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important; line-height:0.8rem">
                            <span class="badge bg-danger" style="position: absolute; top:3px; right:5px; font-size:0.6rem;
                            z-index:999">{{ $rekappresensi->jmlterlambat != null ? $rekappresensi->jmlterlambat : 0 }}</span>
                            <ion-icon name="hourglass" style="font-size: 1.6rem" class="text-danger mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Telat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </br>
</div>
@endsection