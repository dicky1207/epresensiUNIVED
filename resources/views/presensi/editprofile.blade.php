@extends('layouts.presensi')
@section('header')
 <!-- App Header -->
 <div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Edit Profil</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection

@section('content')
<div class="row" style="margin-top: 4rem">
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
<form action="/presensi/{{ $pegawai->nik }}/updateprofile" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col">
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" class="form-control" value="{{ $pegawai->nama_lengkap }}" name="nama_lengkap" placeholder="Nama Lengkap" autocomplete="off">
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" class="form-control" value="{{ $pegawai->no_hp }}" name="no_hp" placeholder="No. Handphone" autocomplete="off">
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" class="form-control" value="{{ $pegawai->email }}" name="email" placeholder="E-mail" autocomplete="off">
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
            </div>
        </div>
        <div class="custom-file-upload" id="fileUpload1">
            <input type="file" name="foto" id="fileuploadInput">
            <label for="fileuploadInput">
                <span>
                    <strong>
                        <ion-icon name="cloud-upload"></ion-icon>
                        <i>Unggah Foto</i>
                    </strong>
                </span>
            </label>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <button type="submit" class="btn btn-primary btn-block">
                    <ion-icon name="refresh-outline"></ion-icon>
                    Update
                </button>
            </div>
        </div>
    </div>
</form>
@endsection