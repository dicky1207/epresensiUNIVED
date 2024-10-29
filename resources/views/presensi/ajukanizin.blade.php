@extends('layouts.presensi')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
<style>
    .datepicker-modal{
        max-height: 430px !important;
    }

    .datepicker-date-display {
        background-color: #0f3a7e !important;
    }
    .form-control{
        height: 35px;
        line-height: 1.5rem !important;
        padding: 0.2rem !important;
    }

    .form-label{
        font-size: 1rem !important;
        color: #000000 !important;
        margin-bottom: auto !important;
    }
</style>
 <!-- App Header -->
 <div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Form Cuti/Izin</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection
@section('content')
    <div class="row" style="margin-top:70px">
        <div class="col">
            <form method="POST" action="/presensi/storeizin" id="frmIzin" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <input type="text" id="tgl_awal" name="tgl_awal" class="form-control datepicker" autocomplete="off" placeholder="Tanggal Awal">
                    </div>
                    <div class="col-6">
                        <input type="text" id="tgl_akhir" name="tgl_akhir" class="form-control datepicker" autocomplete="off" placeholder="Tanggal Akhir">
                    </div>
                </div>
                <div class="form-group">
                    <select name="status" id="status" class="form-control">
                        <option value="">Status</option>
                        <option value="c">Cuti</option>
                        <option value="i">Izin</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea name="keterangan" id="keterangan" cols="30" rows="7" class="form-control" placeholder="Keterangan"></textarea>
                </div>
                <div class="mb-3">
                    <div class="form-label">Lampiran</div>
                    <input type="file" id="lampiran" name="lampiran" class="form-control" accept=".pdf, .docx, .doc">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary w-100">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        var currYear = (new Date()).getFullYear();

        $(document).ready(function() {
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd"    
        });

        $("#tgl_awal").change(function(e){
            var tgl_awal = $(this).val();
            
            $.ajax({
            type: 'POST',
            url: '/panel/presensi/cekizincuti',
            data: {
                _token: "{{ csrf_token() }}",
                tgl_awal: tgl_awal,
            },
                cache:false,
                success:function(respond){
                    if (respond == 1){
                        Swal.fire({
                        title: 'Oops !',
                        text: 'Anda Sudah Mengirim Pengajuan Pada Tanggal Tersebut',
                        icon: 'warning',
                    }).then((result) => {
                        $("#tgl_awal").val("");
                    });
                    }
                }
            });
        });

        $("#frmIzin").submit(function()
        {
            var tgl_awal = $("#tgl_awal").val();
            var tgl_akhir = $("#tgl_akhir").val();
            var status = $("#status").val();
            var keterangan = $("#keterangan").val();
            var lampiran = $("#lampiran").val();
            if (tgl_awal == "") {
                Swal.fire({
                    title: 'Oops !',
                    text: 'Tanggal Awal Harus Diisi',
                    icon: 'warning',
                });
                return false;
            } else if (tgl_akhir == "") {
                Swal.fire({
                    title: 'Oops !',
                    text: 'Tanggal Akhir Harus Diisi',
                    icon: 'warning',
                });
                return false;
            } else if (status == "") {
                Swal.fire({
                    title: 'Oops !',
                    text: 'Status Harus Diisi',
                    icon: 'warning',
                });
                return false;
            } else if (keterangan == "") {
                Swal.fire({
                    title: 'Oops !',
                    text: 'Keterangan Harus Diisi',
                    icon: 'warning',
                });
                return false;
            }
        });

        });
    </script>
@endpush