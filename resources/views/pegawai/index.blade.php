@extends('layouts.admin.master')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <h2 class="page-title">
            Data Pegawai
          </h2>
        </div>
      </div>
    </div>
  </div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if(Session::get('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                @if(Session::get('warning'))
                                    <div class="alert alert-warning">
                                        {{ Session::get('warning') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="#" class="btn btn-primary" id="btnTambahPegawai">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  
                                    fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  
                                    stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" /></svg>
                                    Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <form action="/panel/pegawai" method="GET">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" placeholder="Nama Pegawai" value="{{ Request('nama_pegawai') }}">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <select name="kode_dept" id="kode_dept" class="form-select">
                                                    <option value="">Departemen</option>
                                                    @foreach ($departemen as $d)
                                                        <option {{ Request('kode_dept')==$d->kode_dept ? 'selected' : '' }} value="{{ $d->kode_dept }}">{{ $d->nama_dept }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  
                                                    fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                    <path d="M21 21l-6 -6" /></svg>
                                                    Cari
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Departemen</th>
                                            <th>No. HP</th>
                                            <th>E-mail</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pegawai as $d)
                                        @php
                                            $path = Storage::url('uploads/pegawai/'.$d->foto);
                                        @endphp
                                            <tr>
                                                <td>{{ $loop->iteration + $pegawai->firstItem() -1 }}</td>
                                                <td>{{ $d->nik }}</td>
                                                <td>{{ $d->nama_lengkap }}</td>
                                                <td>{{ $d->jabatan }}</td>
                                                <td>{{ $d->nama_dept }}</td>
                                                <td>{{ $d->no_hp }}</td>
                                                <td>{{ $d->email }}</td>
                                                <td>
                                                    @if (empty($d->foto))
                                                    <img src="{{ asset('assets/img/nophoto.png') }}" class="avatar" alt="">
                                                    @else
                                                    <img src="{{ url($path) }}" class="avatar" alt="">
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <div>
                                                        <a href="#" class="edit btn btn-warning btn-sm" nik="{{ $d->nik }}">
                                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                            <path d="M16 5l3 3" />
                                                            </svg>
                                                        </a>
                                                        </div>
                                                        <div>
                                                        <form action="/panel/pegawai/{{ $d->nik }}/delete" method="POST" style="margin-left:7px">
                                                            @csrf
                                                            <a href="#" class="btn btn-danger btn-sm delete-confirm">
                                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" />
                                                                <path d="M10 11l0 6" /><path d="M14 11l0 6" />
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                </svg>
                                                            </a>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $pegawai->links('vendor.pagination.bootstrap-5') }}
                            </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-inputpegawai" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/panel/pegawai/store" method="POST" id="frmPegawai" name="frmPegawai" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-2">
                        <span class="input-icon-addon">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-id">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                            <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M15 8l2 0" />
                            <path d="M15 12l2 0" />
                            <path d="M7 16l10 0" />
                            </svg>
                        </span>
                        <input type="text" maxlength="7" value="" class="form-control" id="nik" name="nik" placeholder="NIK">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-2">
                        <span class="input-icon-addon">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            </svg>
                        </span>
                        <input type="text" value="" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-2">
                        <span class="input-icon-addon">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-award">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 9m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0" />
                            <path d="M12 15l3.4 5.89l1.598 -3.233l3.598 .232l-3.4 -5.889" />
                            <path d="M6.802 12l-3.4 5.89l3.598 -.233l1.598 3.232l3.4 -5.889" />
                            </svg>
                        </span>
                        <input type="text" value="" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <select name="kode_dept" id="kode_dept" class="form-select">
                        <option value="">Departemen</option>
                        @foreach ($departemen as $d)
                            <option {{ Request('kode_dept')==$d->kode_dept ? 'selected' : '' }} value="{{ $d->kode_dept }}">{{ $d->nama_dept }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-2">
                        <span class="input-icon-addon">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-sim">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M6 3h8.5l4.5 4.5v12.5a1 1 0 0 1 -1 1h-12a1 1 0 0 1 -1 -1v-16a1 1 0 0 1 1 -1z" />
                            <path d="M9 11h3v6" /><path d="M15 17v.01" /><path d="M15 14v.01" />
                            <path d="M15 11v.01" /><path d="M9 14v.01" /><path d="M9 17v.01" /></svg>
                        </span>
                        <input type="text" value="" class="form-control" id="no_hp" name="no_hp" placeholder="No. Handphone">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-2">
                        <span class="input-icon-addon">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                            <path d="M3 7l9 6l9 -6" /></svg>
                        </span>
                        <input type="text" value="" class="form-control" id="email" name="email" placeholder="E-mail">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="file" id="foto" name="foto" class="form-control" accept=".png, .jpg, .jpeg">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="input-icon mb-2">
                        <span class="input-icon-addon">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-key">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" />
                            <path d="M15 9h.01" /></svg>
                        </span>
                        <input type="text" value="" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="form-group">
                        <button class="btn btn-primary w-100">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-send">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" />
                        <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                        Simpan
                        </button>
                    </div>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal modal-blur fade" id="modal-editpegawai" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="loadeditform">

        </div>
      </div>
    </div>
</div>
@endsection

@push('myscript')
    <script>
        $(function(){

            $("#nik").mask("0000000");
            $("#no_hp").mask("0000000000000");
            $("#btnTambahPegawai").click(function(){
                $("#modal-inputpegawai").modal("show");
            });

            $(".edit").click(function(){
                var nik = $(this).attr('nik');
                $.ajax({
                    type:'POST',
                    url:'/panel/pegawai/edit',
                    cache:false,
                    data:{
                        _token:"{{ csrf_token(); }}",
                        nik:nik
                    },
                    success:function(respond){
                        $("#loadeditform").html(respond);
                    }
                });
                $("#modal-editpegawai").modal("show");
            });

            $(".delete-confirm").click(function(e){
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                title: "Apakah Anda Yakin Ingin Menghapus Data Ini?",
                text: "Jika Iya Maka Data Akan Terhapus Permanen",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete"
                }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire({
                    title: "Deleted!",
                    text: "Data Pegawai Berhasil Dihapus",
                    icon: "success"
                    });
                }
                });
            });

            $("#frmPegawai").submit(function(){
                var nik = $('#nik').val();
                var nama_lengkap = $('#nama_lengkap').val();
                var jabatan = $('#jabatan').val();
                var kode_dept = $('#frmPegawai').find('#kode_dept').val();
                var no_hp = $('#no_hp').val();
                var email = $('#email').val();
                var foto = $('#foto').val();
                var password = $('#password').val();
                if (nik == ""){
                    Swal.fire({
                    text: 'NIK Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#nik").focus();
                    });
                    return false;
                }else if(nama_lengkap == ""){
                    Swal.fire({
                    text: 'Nama Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#nama_lengkap").focus();
                    });
                    return false;
                }else if(jabatan == ""){
                    Swal.fire({
                    text: 'Jabatan Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#jabatan").focus();
                    });
                    return false;
                }else if(kode_dept == ""){
                    Swal.fire({
                    text: 'Departemen Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#kode_dept").focus();
                    });
                    return false;
                }else if(no_hp == ""){
                    Swal.fire({
                    text: 'No. HP Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#no_hp").focus();
                    });
                    return false;
                }else if(email == ""){
                    Swal.fire({
                    text: 'E-mail Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#email").focus();
                    });
                    return false;
                }else if(password == ""){
                    Swal.fire({
                    text: 'Password Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#password").focus();
                    });
                    return false;
                }
            });
        });
    </script>
@endpush