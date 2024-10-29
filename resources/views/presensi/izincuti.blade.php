@extends('layouts.admin.master')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <h2 class="page-title">
            Data Cuti / Izin
          </h2>
        </div>
      </div>
    </div>
  </div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <form action="/panel/presensi/izincuti" method="GET" autocomplete="off">
                    <div class="row">
                        <div class="col-3">
                            <div class="input-icon mb-2">
                                <span class="input-icon-addon">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-search">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4.5" />
                                    <path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                    <path d="M20.2 20.2l1.8 1.8" />
                                    </svg>
                                </span>
                                <input type="text" value="{{ Request('dari') }}" class="form-control" id="dari" name="dari" placeholder="Dari Tanggal">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-icon mb-2">
                                <span class="input-icon-addon">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-search">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4.5" />
                                    <path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                    <path d="M20.2 20.2l1.8 1.8" />
                                    </svg>
                                </span>
                                <input type="text" value="{{ Request('sampai') }}" class="form-control" id="sampai" name="sampai" placeholder="Sampai Tanggal">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
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
                                <input type="text" value="{{ Request('nik') }}" class="form-control" id="nik" name="nik" placeholder="NIK">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-icon mb-2">
                                <span class="input-icon-addon">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    </svg>
                                </span>
                                <input type="text" value="{{ Request('nama_lengkap') }}" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Pegawai">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <select name="status_approvement" id="status_approvement" class="form-select">
                                    <option value="">Pilih Status</option>
                                    <option value="0" {{ Request('status_approvement') === '0' ? 'selected' : '' }}>Pending</option>
                                    <option value="1" {{ Request('status_approvement') == 1 ? 'selected' : '' }}>Disetujui</option>
                                    <option value="2" {{ Request('status_approvement') == 2 ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
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
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Lampiran</th>
                            <th>Status Approvement</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($izincuti as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date('d-m-Y', strtotime($d->tgl_awal)) . ' s/d ' . date('d-m-Y', strtotime($d->tgl_akhir)) }}</td>
                                <td>{{ $d->nik }}</td>
                                <td>{{ $d->nama_lengkap }}</td>
                                <td>{{ $d->jabatan }}</td>
                                <td>{{ $d->status == "i" ? "Izin" : "Cuti" }}</td>
                                <td>{{ $d->keterangan }}</td>
                                <td>
                                    <a href="{{ Storage::url($d->lampiran) }}" target="_blank">
                                        {{ basename($d->lampiran) }}
                                    </a>
                                </td>
                                <td>
                                    @if($d->status_approvement == 1)
                                    <span class="badge bg-success text-white">Disetujui</span>
                                    @elseif ($d->status_approvement == 2)
                                    <span class="badge bg-danger text-white">Ditolak</span>
                                    @else
                                    <span class="badge bg-warning text-white">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if($d->status_approvement == 0)
                                    <a href="" class="btn btn-primary btn-sm" id="approval" id_izincuti="{{ $d->id }}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                        </svg>
                                        Approval
                                    </a>
                                    @else
                                    <a href="/panel/presensi/{{ $d->id }}/batalkanizincuti" class="btn btn-warning btn-sm">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" />
                                        </svg>
                                        Batalkan
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $izincuti->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-izincuti" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Status Approvement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/panel/presensi/approvalizincuti" method="POST">
                @csrf
                <input type="hidden" id="id_izincuti_form" name="id_izincuti_form">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <select name="status_approvement" id="status_approvement" class="form-select">
                                <option value="">Pilih Status</option>
                                <option value="1">Disetujui</option>
                                <option value="2">Ditolak</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100">
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
@endsection

@push('myscript')
    <script>
        $(function(){
            $("#approval").click(function(e){
                e.preventDefault();
                var id_izincuti = $(this).attr("id_izincuti");
                $("#id_izincuti_form").val(id_izincuti);
                $("#modal-izincuti").modal("show");
            });

            $("#dari, #sampai").datepicker({ 
            autoclose: true, 
            todayHighlight: true,
            format: 'yyyy-mm-dd'
            });
        });
    </script>
@endpush